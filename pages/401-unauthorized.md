---
title: Unauthorized
robots: noindex,nofollow
template: micropub
routable: true
http_response_code: 401
twig_first: true
process:
  twig: true
never_cache_twig: true
---

{{ 'PLUGIN_MICROPUB.MESSAGES.UNAUTHORIZED'|t }}