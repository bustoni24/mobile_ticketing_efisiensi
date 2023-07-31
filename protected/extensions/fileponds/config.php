<?php

// where to get files from
const ENTRY_FIELD = array('filepond');
const BASE_PATH_UPLOAD = './protected/extensions/fileponds';
// where to write files to
const TRANSFER_DIR = BASE_PATH_UPLOAD . '/tmp/';
const UPLOAD_DIR = BASE_PATH_UPLOAD . '/images/';
const DATABASE_FILE = BASE_PATH_UPLOAD . '/database.json';

// name to use for the file metadata object
// const METADATA_FILENAME = '.metadata';

// this automatically creates the upload and transfer directories, if they're not there already
if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755);
if (!is_dir(TRANSFER_DIR)) mkdir(TRANSFER_DIR, 0755);