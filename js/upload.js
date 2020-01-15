function upload(){
    var self = {};
    self.options = {'document': {'file_name': 'document', 'multiple': true, 'oncomplite': onUploadComplete}};
    self.uploadUrls = {'document': apiUrl + '/chain/upload'};

    self.onFile = function(type, files){
        if (!files || !files.length) return;
        var options = self.options[type];

        console.log(!options.multiple && files.length > 1);
        if (!options.multiple && files.length > 1) {
            files = [files[0]]
        }
        console.log(files);

        self.uploadFiles(type, files, files.length);
    }

    self.uploadFiles = function(type, files, max_files){
        var options = self.options[type];

        var filesQueue = [];
        var params = [];
        var totalSize, totalCount;
        var vars = {};

        for (var j in vars) {
            params.push(j + "=" + vars[j]);
        }
        var uploadUrl = self.uploadUrls[type] + (self.uploadUrls[type].match(/\?/) ? '&' : '?') + params.join('&'),
            fileName;

        var errors = false;
        for (var j = 0; j < max_files; j++) {
            fileName = files[j].name;
            if (options.file_match) {
              if (!fileName.match(re)) {
                errors = true;
                continue;
              }
            }
            if (options.multi_progress && !options.multi_sequence) {
              self.onUploadStart({ind: type, fileName: fileName});
            }
            totalSize += files[j].size;
            totalCount += 1;
            filesQueue.push(files[j]);
        }

        if (filesQueue.length > 0) {
            options.type = type;
            options.filesTotalSize = totalSize;
            options.filesLoadedSize = 0;
            options.filesTotalCount = totalCount;
            options.filesLoadedCount = 0;
            for (var j = 0; j < max_files; j++) {
              self.uploadFile(options, filesQueue.pop(), uploadUrl);
            }
              //if (options.multi_progress) cur.multiProgressIndex = iUpload;
        } else if (errors) {
            self.onUploadError(type, 'file type not supported');
        }
    }

    self.onUploadStart = function(options){

    }

    self.onUploadProgress = function(info, loaded, total){
        
    }

    self.onUploadComplete = function(info, result){
        
    }

    self.onUploadCompleteAll = function(info, result){
        var options = self.options[info];

        if(options.oncomplite){
            options.oncomplite(result);
        }
    }

    self.getFileInfo = function(type, options, file){
        return options.multi_progress ? {
            ind: type,
            fileName: (file) ? (file.fileName || file.name || '').replace(/[&<>"']/g, '') : '',
            num: options.filesLoadedCount,
            totalSize: options.filesTotalSize,
            loadedSize: options.filesLoadedSize,
            totalCount: options.filesTotalCount,
            file: file
        } : type;
    }

    self.uploadFile = function(options, file, url){
        //var XHR = (browser.msie && intval(browser.version) < 10) ? window.XDomainRequest : window.XMLHttpRequest;
        var XHR = window.XMLHttpRequest;

        var info = self.getFileInfo(options.type, options, file);

        if (options.multi_sequence) {
            self.onUploadStart(info);
        }

        options.uploading = true;

        if (window.FormData) {
            var formData = new FormData();

            console.log('----');
            console.log(file);
            console.log(info);

            if (file instanceof File) {
              formData.append(options.file_name, file);
            } else { // blob
              formData.append(options.file_name, file, file.filename.replace(/[&<>"']/g, '') + '.png');
            }

            formData.append('Authorization', token);

            var xhr = new XHR(), fastFail = true;
            xhr.open('POST', url, true);
            xhr.onload = function(e) {
                var data = eval('('+e.target.responseText+')');
              //extend(info, Upload.getFileInfo(iUpload, options, file)); // can be extended
              //Upload.options[iUpload].filesLoadedSize += file.size;
              //Upload.options[iUpload].filesLoadedCount += 1;
              //Upload.onUploadComplete(info, e.target.responseText);
              //if (Upload.options[iUpload].filesQueue && Upload.options[iUpload].filesQueue.length > 0) {
              //  Upload.uploadFile(iUpload, Upload.options[iUpload].filesQueue.pop(), url);
              //} else {
              //  Upload.startNextQueue(iUpload);
                self.onUploadCompleteAll(info, data);
                options.uploading = false;
              //}
            };
            xhr.onerror = function(e) {
              //if (false && !e.target.responseText && fastFail) { // Disabled. Replace it by layer to prevent losing unsaved changes on the page.
              //  return nav.go('/login?act=upload_fail', false, {nocur: true, params: {context: 0, name: (file.fileName || file.name || '').replace(/[&<>"']/g, '')}});
              //}
              //extend(info, Upload.getFileInfo(iUpload, options, file));
             // Upload.options[iUpload].filesTotalSize -= file.size;
              //Upload.options[iUpload].filesTotalCount -= 1;
              //Upload.onUploadError(info, e.target.responseText);
              //if (Upload.options[iUpload].filesQueue.length > 0) {
              //  Upload.uploadFile(iUpload, Upload.options[iUpload].filesQueue.pop(), url);
              //} else {
              //  Upload.startNextQueue(iUpload);
              //  Upload.onUploadCompleteAll(info, e.target.responseText);
              //  options.uploading = false;
              //}
            };
            xhr.upload.onprogress = function(e) {

              if (xhr.readyState === 4) {
                return;
              }

              fastFail = false;
              //extend(info, Upload.getFileInfo(iUpload, options, file));
              if (e.lengthComputable) {
                if (!options.multi_progress) {
                  self.onUploadProgress(options.type, Math.min(e.loaded + options.filesLoadedSize, options.filesTotalSize), options.filesTotalSize);
                } else {
                  self.onUploadProgress(info, e.loaded, e.total);
                }
              }
            };
            xhr.send(formData);
        } else try {
            if (XHR && !XHR.prototype.sendAsBinary && window.ArrayBuffer && window.Uint8Array) {
              var BlobBuilder = window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder;
              if (BlobBuilder) {
              //  XHR.prototype.sendAsBinary = function(text){
              //    var data = new ArrayBuffer(text.length);
              //    var ui8a = new Uint8Array(data, 0);
              //    for (var i = 0; i < text.length; i++) ui8a[i] = (text.charCodeAt(i) & 0xff);
              //    var bb = new BlobBuilder();
              //    bb.append(data);
              //    var blob = bb.getBlob();
              //    this.send(blob);
              //  }
              }
            }

            var reader = new FileReader();

            reader.onload = function() {
              var xhr = new XHR(), fastFail = true;

              xhr.onload = function(e) {
                //extend(info, Upload.getFileInfo(iUpload, options, file));
                //Upload.options[iUpload].filesLoadedSize += file.size;
                //Upload.options[iUpload].filesLoadedCount += 1;
                self.onUploadComplete(info, e.target.responseText);
                //if (Upload.options[iUpload].filesQueue.length > 0) {
                //  Upload.uploadFile(iUpload, Upload.options[iUpload].filesQueue.pop(), url);
                //} else {
                //  Upload.startNextQueue(iUpload);
                //  Upload.onUploadCompleteAll(info, e.target.responseText);
                //}
              };
              xhr.onerror = function(e) {
                //if (false && !e.target.responseText && fastFail) { // Disabled. Replace it by layer to prevent losing unsaved changes on the page.
               //   return nav.go('/login?act=upload_fail', false, {nocur: true, params: {context: 1, name: (file.fileName || file.name || '').replace(/[&<>"']/g, '')}});
                //}
                //extend(info, Upload.getFileInfo(iUpload, options, file));
                //Upload.options[iUpload].filesTotalSize -= file.size;
                //Upload.options[iUpload].filesTotalCount -= 1;
               // Upload.onUploadError(info, e.target.responseText);
                //if (Upload.options[iUpload].filesQueue.length > 0) {
                //  Upload.uploadFile(iUpload, Upload.options[iUpload].filesQueue.pop(), url);
                //} else {
                //  Upload.startNextQueue(iUpload);
                //  Upload.onUploadCompleteAll(info, e.target.responseText);
                //  options.uploading = false;
                //}
              };
              xhr.upload.onprogress = function(e) {
                //fastFail = false;
                //extend(info, Upload.getFileInfo(iUpload, options, file));
                //if (e.lengthComputable) {
                //  if (!options.multi_progress) {
                //    Upload.onUploadProgress(iUpload, Math.min(e.loaded + options.filesLoadedSize, options.filesTotalSize), options.filesTotalSize);
                //  } else {
                //    Upload.onUploadProgress(info, e.loaded, e.total);
                //    options.uploading = false;
                //  }
                //}
              };

              xhr.open('POST', url, true);
              var boundary = '---------' + irand(1111111111, 9999999999);
              xhr.setRequestHeader("Content-Type", "multipart/form-data, boundary=" + boundary);
              var body = '--' + boundary + "\r\n";
              body += "Content-Disposition: form-data; name='" + options.file_name + "'; filename='" + file.name.replace(/[&<>"']/g, '') + "'\r\n";
              body += "Content-Type: application/octet-stream\r\n\r\n";
              body += reader.result + "\r\n";
              body += '--' + boundary + '--';

              xhr.sendAsBinary(body);
            };
            reader.readAsBinaryString(file);
        } catch (e) {
            try { console.error(e); } catch (e2) {}
        }
    }

    return self;
}
var upload = new upload();