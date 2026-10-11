# Social Network for Joomla 5/6

This repository contains a staged implementation of a Google+-inspired social network component for Joomla 5/6.

## Stage 1: Project skeleton
The initial scaffold provides a working Joomla component foundation with:
- component package manifest
- admin dashboard and ACL
- frontend feed/profile entry point
- template shell
- SQL install/uninstall migration files
- core media assets

## Stage 2: Social graph foundation
This stage added:
- user profile model and view
- circles CRUD
- communities CRUD
- follow relationship logic
- AJAX-based follow action
- responsive CSS

## Stage 3: Post stream and interaction layer
This stage adds the core social interaction functionality:
- publishing posts with text and optional links
- hashtag extraction and persistence
- comments on posts
- +1 reactions
- AJAX interactions without reload
- feed template with composer, comments, and reaction actions

This keeps the project in a consistent and installable state while adding real social media workflow behavior.
