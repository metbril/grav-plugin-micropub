---
title: Internal Server Error
robots: noindex,nofollow
template: micropub
routable: true
http_response_code: 500
twig_first: true
process:
  twig: true
never_cache_twig: true
cache_enable: false
---

{{ 'PLUGIN_MICROPUB.MESSAGES.INTERNAL_SERVER_ERROR'|t }}

{{ config.plugins.micropub._msg }}
