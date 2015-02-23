README
===========

Avaman is a little module for managing System Avatars and Smilies.

 Requirements
 _____________________________________________________________________
 
- XOOPS >= 2.5.0
- PHP version >= 5.2.0
- ModuleClasses in /Frameworks (download it from here: http://goo.gl/Bmknt)  


USAGE:

Just install it.
You can upload avatars/smilies via an archive of tar.gz or zip.

If you are a smilies creator and want to distribute it, name the file like this.

(code).gif
(code).jpg
(code).png

(code) should be urlencoded. (eg '*'=>'%2A', '<'=>%3C, '|'=>%7C)

If you make a smile gif for :anotherpint:, name it like this:
[code]%3Aanotherpint%3A.gif[/code]
It will be imported as a smile with its code :anotherpint:

Then archive all smile images as a zip file, and distribute it.
It makes many Xoopsers happy!