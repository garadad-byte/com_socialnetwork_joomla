# Social Network for Joomla 5/6

This repository contains a staged implementation of a Google+-inspired social network component for Joomla 5/6.

## Stage 1: Project skeleton and installable base

This first stage establishes:

- Joomla component scaffold: `com_socialnetwork`
- Admin dashboard and ACL
- Frontend component entry points and feed/profile views
- Template skeleton
- SQL install/uninstall migration files
- Media assets
- Joomla package manifest for installable packaging

## Architecture

- Component: `administrator/components/com_socialnetwork`
- Site: `components/com_socialnetwork`
- Assets: `media/com_socialnetwork`
- Template: `templates/tmpl_socialplus`
- Package manifest: `pkg_socialnetwork.xml`

## Planned domain modules

- Profiles
- Circles
- Communities
- Posts, media, links, hashtags
- Comments and reactions
- Notifications
- Messages
- Events
- Privacy settings and blocks
- Moderation and reports
- Search and invitations
- Hangouts / P2P signaling skeleton

## Notes

This repository intentionally begins as a working, installable scaffold rather than a mockup. The implementation is modular and designed to be extended in subsequent stages without breaking the base architecture.
