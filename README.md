User Photo
==========

<em>application of ownCloud</em> :-).

Supply a field to store the user's photo.

Changelog
---------

### version 0.6

+ App rewritten, instead of using a file path, any image file can be uploaded and is stored in the database. 
+ It is resized to a max 400px (either height or width) first to save space before it's base 64 encoded.
+ The image can be called in other apps by calling to /apps/user_photo/photo.php?uid=*USERID*
+ The 'thumb=x' variable can be added to load a square image, cropped at whatever size 'x' is, i.e. /apps/user_photo/photo.php?uid=*USERID*&thumb=120 will return a central cropped image at 120x120

### version 0.5

+ migration to github ...