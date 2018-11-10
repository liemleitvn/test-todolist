require("bootstrap");
require("bootstrap-show-modal");

export default class Modal {
    static show(title, body, footer = null, onCreate = null) {
        $.showModal({
            title: title,
            body: body,
            footer: footer,
            onCreate: onCreate
        })
    }
}