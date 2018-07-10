'use strict';

const parametersModule = (function () {
    let _from;
    let _to;
    let _subject;
    let _message;

    /**
     *
     * @param from
     * @returns {setFrom}
     */
    const setFrom = function (from) {
        _from = from;
        return this;
    };

    /**
     *
     * @param to
     * @returns {setTo}
     */
    const setTo = function (to) {
        _to = to;
        return this;
    };

    /**
     *
     * @param subject
     * @returns {setSubject}
     */
    const setSubject = function (subject) {
        _subject = subject;
        return this;
    };

    /**
     *
     * @param message
     * @returns {setMessage}
     */
    const setMessage = function (message) {
        _message = message;
        return this;
    };

    /**
     *
     * @returns {{from: *, to: *, subject: *, message: *}}
     */
    const getParams = function () {
        return {
            from: _from,
            to: _to,
            subject: _subject,
            message: _message
        };
    };

    return {
        setFrom: setFrom,
        setTo: setTo,
        setSubject: setSubject,
        setMessage: setMessage,
        getParams: getParams
    };

})();

module.exports = parametersModule;