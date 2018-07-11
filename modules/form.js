'use strict';

const sender = require('./sender');
const templateTexts = require('./template');
const parameters = require('./parameters');

const formModule = (function (sender, templateTexts, parameters) {

    const toAddress = process.env.TO_ADDRESS;
    const fromAddress = process.env.FROM_ADDRESS;
    const subject = process.env.MAIL_SUBJECT;

    const getTemplateParameters = (requestBody) => ({
        messageBody: requestBody.message,
        from: requestBody.from,
        name: requestBody.name
    });

    /**
     *
     * @param requestBody
     * @returns {*}
     */
    const sendForm = function (requestBody) {

        let templateParameters = getTemplateParameters(requestBody);

        parameters.setFrom(fromAddress)
            .setTo(toAddress)
            .setSubject(subject)
            .setTxtMessage(templateTexts.getTextTemplate(templateParameters))
            .setHtmlMessage(templateTexts.getHtmlTemplate(templateParameters));

        return sender.sendForm(parameters.getParams());
    };

    return {
        sendForm: sendForm
    }

})(sender, templateTexts, parameters);

module.exports = formModule;