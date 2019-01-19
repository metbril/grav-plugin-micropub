---
title: Forbidden
robots: noindex,nofollow
template: micropub
routable: true
http_response_code: 403
twig_first: true
process:
  twig: true
never_cache_twig: true
cache_enable: false
---

{{ 'PLUGIN_MICROPUB.MESSAGES.UNAUTHORIZED'|t }}

{{ config.plugins.micropub._msg }}