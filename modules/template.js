'use strict';

const ejs = require('ejs');

const templateModule = (function (ejs) {
    const textTemplate = 'Message: <%= messageBody %>';

    const textBody = ejs.compile(textTemplate, {});

    /**
     *
     * @param data
     * @returns {*}
     */
    const getTextTemplate = (data) => textBody(data);

    return {
        getTextTemplate: getTextTemplate
    }
})(ejs);

module.exports = templateModule;