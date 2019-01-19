---
robots: noindex,nofollow
template: micropub
template_format: json
routable: true
twig_first: true
process:
  twig: true
never_cache_twig: true
cache_enable: false
---

{{ config.plugins.micropub._payload }}
