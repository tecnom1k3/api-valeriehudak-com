'use strict';

const ejs = require('ejs');
const fs = require('fs');

const templateModule = (function (ejs, fs) {

    const textTemplate = fs.readFileSync('views/message.txt', 'utf-8');
    const textBody = ejs.compile(textTemplate, {});
    const htmlTemplate = fs.readFileSync('views/message.html', 'utf-8');
    const htmlBody = ejs.compile(htmlTemplate, {});

    /**
     *
     * @param data
     * @returns {*}
     */
    const getTextTemplate = (data) => textBody(data);

    const getHtmlTemplate = (data) => htmlBody(data);

    return {
        getTextTemplate: getTextTemplate,
        getHtmlTemplate: getHtmlTemplate
    }
})(ejs, fs);

module.exports = templateModule;