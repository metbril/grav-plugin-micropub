---
title: Bad Request
robots: noindex,nofollow
template: micropub
routable: true
http_response_code: 400
twig_first: true
process:
  twig: true
never_cache_twig: true
---

{{ 'PLUGIN_MICROPUB.MESSAGES.BAD_REQUEST'|t }}