# Micropub Plugin

> NOTE: This plugin is currently **in alpha**. Features are slowly added.

The **Micropub** Plugin is for [Grav CMS](http://github.com/getgrav/grav) and implements a [Micropub](https://indieweb.org/Micropub) [server endpoint](https://indieweb.org/Micropub/Servers) for the [IndieWeb](https://indieweb.org/).

## Installation

Installing the Micropub plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install micropub

This will install the Micropub plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/micropub`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `micropub`. You can find these files on [GitHub](https://github.com/metbril/grav-plugin-micropub) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/micropub

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/micropub/micropub.yaml` to `user/config/plugins/micropub.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
route: /micropub
advertise_method: header
token_endpoint:
parent_page:
post_template:
destination:
```

Option | Description
---|---
`enabled` | Enable or disable the plugin
`route` | The route to the endpoint
`advertise_method` | The method used to advertise the endpoint. This can be in the HTML `<head>` header or as a `<link>` inside the page `<body>`.
`token_endpoint` | Your authorization token endpoint. This should be the same as advertised on your home page.
`parent_page` | The parent page that any new page will be created under
`post_template` | The filename of the page template, also used for rendering your output.
`destination` | A list of available endpoint destinations. Posts can be saved as a child to one of these. If a Micropub endpoint does not support destinations, the first one is used by default.

Note that if you use the admin plugin, a file with your configuration, and named `micropub.yaml` will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

Currently supported:

- Deliver a Micropub endpoint with multiple destinations
- Advertise the endpoint in your site

After configuration, you can use any Micropub client to publish content to your site.
Some publicly available web clients are:

- [Quill](https://quill.p3k.io/) by [Aaron Parecki](https://aaronparecki.com/)
- [Micropublish](https://micropublish.net/) by [Barry Frost](https://barryfrost.com/)

To be able to use any client, you will also need to be able to provide those IndieAuth authentication. The easiest way to achieve this is, to install the [IndieAuth plugin](https://github.com/metbril/grav-plugin-indieauth).

## Credits

This plugin is largely inspired by:

- [minimal micropub endpoint](https://gist.github.com/adactio/8168e6b78da7b16a4644) by [Jeremy Keith](https://github.com/adactio)
- [nanopub](https://github.com/dg01d/nanopub) by [Daniel Goldsmith](https://github.com/dg01d)
- [webmention plugin](https://github.com/Perlkonig/grav-plugin-webmention) by [Aaron Dalton](https://github.com/Perlkonig)

## To Do

This plugin is currently in alpha. Features are slowly added.

- [ ] Add micropub media endpoint
- [ ] Read token endpoint from home page instead of configuration
- [ ] Get parent page from blog configuration
