import toastr from 'toastr';

export default class Toast {

    static notify(message) {
        toast(message);
    }

    static success(message) {
        toastr.success('', message);
    }

    static error(message) {
        toastr.error('', message);
    }

    static warn(message) {
        toastr.warn('', message);
    }

    static info(message) {
        toastr.info('', message);
    }
}