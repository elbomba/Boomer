﻿/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	 config.language = 'it';
	// config.uiColor = '#AADC6E';
        CKEDITOR.config.protectedSource.push(/<\?[\s\S]*?\?>/g);
};
