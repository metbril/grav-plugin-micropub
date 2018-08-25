<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Common\Config\Config;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class MicropubPlugin
 * @package Grav\Plugin
 */
class MicropubPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $config = $this->grav['config'];
        $enabled = array();

        // ADVERTISE
        $advertise = $config->get('plugins.micropub.advertise_method');
        if ($advertise === 'header') {
            $enabled = $this->addEnable($enabled, 'onPagesInitialized', ['advertiseHeader', 100]);
        } elseif ($advertise === 'link') {
            $enabled = $this->addEnable($enabled, 'onOutputGenerated', ['advertiseLink', 100]);
        }

        $this->enable($enabled);
    }
    public function advertiseHeader(Event $e) {
        $uri = $this->grav['uri'];
        $config = $this->grav['config'];
        // Check if the current requested URL needs to advertise the endpoint.
        if (!$this->shouldAdvertise($uri, $config)) {
            return;
        }
        // Build and send the Link header.
        $root = $uri->rootUrl(true);
        $route = $config->get('plugins.micropub.route');
        $url = $root.$route;
        header('Link: <'.$url.'>; rel="micropub"', false);
    }
    public function advertiseLink(Event $e) {
        $uri = $this->grav['uri'];
        $config = $this->grav['config'];

        // Check if the current requested URL needs to advertise the endpoint.
        if (!$this->shouldAdvertise($uri, $config)) {
            return;
        }
        // Then only proceed if we are working on HTML.
        if ($this->grav['page']->templateFormat() !== 'html') {
            return;
        }
        // After that determine if a HEAD element exists to add the LINK to.
        $output = $this->grav->output;
        $headElement = strpos($output, '</head>');
        if ($headElement === false) {
            return;
        }
        // Build the LINK element.
        $root = $uri->rootUrl(true);
        $route = $config->get('plugins.micropub.route');
        $url = $root.$route;
        $tag = '<link href="'.$url.'" rel="micropub" />'."\n\n";
        // Inject LINK element before the HEAD element's closing tag.
        $output = substr_replace($output, $tag, $headElement, 0);
        // replace output
        $this->grav->output = $output;
    }
    /**
     * Determine whether to advertise the Micropub endpoint on the current page.
     *
     * @param  Uri    $uri    Grav Uri object for the current page.
     * @param  Config $config Grav Config object containing plugin settings.
     *
     * @return boolean
     */
    private function shouldAdvertise(Uri $uri, Config $config) {
        // Do not advertise on the receiver itself.
        if ($this->startsWith($uri->route(), $config->get('plugins.micropub.route'))) {
            return false;
        }
        return true;
    }
    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }    
    private function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }
    private function addEnable ($array, $key, $value) {
        if (array_key_exists($key, $array)) {
            array_push($array[$key], $value);
        } else {
            $array[$key] = [$value];
        }
        return $array;
    }
}
