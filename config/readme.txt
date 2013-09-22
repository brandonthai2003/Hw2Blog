Student:  SJSU Stuent
Class:    CS 174
Semester: Fall 2010

==========================================
THINGS YOU NEED TO KNOW TO RUN THE WEBSITE
==========================================
The website should run as is, as long as you keep the folders and files
in order. ^_^

Username: Triv X
Password: pass

(the letters that come up automatically are not the password -- they
just say "trivial")

==========================
ABOUT THE WIKI_CONFIG FILE
==========================
As far as the config gos, I would prefer you left the parse_mode alone.
When parse_mode is on, the wiki looks for names of other pages within
the content and links to all pages whose names are found (and updates
the file accordingly after edits -- but only after edits, since there's
no real point to update the file for links every time the page is loaded).
When parse_mode is off, the wiki sticks to whatever links happen to be
stored in the file at the time, regardless of whether they are correct
compared to file's current content and the contents of the links' pages.

=============================
ABOUT THE TESTING ENVIRONMENT
=============================
The wiki was tested in Chrome, Firefox 3.6.9, and IE8.  The CSS file
does not validate correctly because of a few browser-specific properties
I had to add.  Despite MSDN's claims, IE8 is not actually "white-space:
pre-wrap" compliant. :(

================
FINAL DISCLAIMER
================
OH, AND IT WAS TESTED ON WINDOWS AND THE FILES USE THE WINDOWS NEWLINE
CHARACTER ("\r\n").  I DO NOT KNOW IF THIS WILL AFFECT FILE EDITING ON OTHER
OPERATING SYSTEMS. >__<  (it'll be okay if they recognize "\r\n" as one
new-line, but if they think it's two new-lines in sequence, things are
going to break.)
