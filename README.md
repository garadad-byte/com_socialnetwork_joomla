# Social Network for Joomla 5/6

This repository contains a staged implementation of a Google+-inspired social network for Joomla 5/6.

## Stage 1 completed

The project now includes a working scaffolding with:

- component package manifest
- admin dashboard and core ACL structure
- site feed/profile entry point
- frontend template skeleton
- SQL schema for profiles, circles, communities, posts, comments, reactions, notifications, messages, events, privacy, reports, moderation and media
- uninstall script
- languages
- AJAX follow endpoint for social relationships

## Stage 2 expansion

This implementation adds the next production layer:

- user profile model and view
- circles CRUD endpoints
- communities CRUD endpoints
- relationship/follow logic using Joomla User API
- feed display and profile page
- adaptive CSS and AJAX interaction logic

These changes keep the project in a coherent, installable state while adding the core social graph and user interaction layer.
