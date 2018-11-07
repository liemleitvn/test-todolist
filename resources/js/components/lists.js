export default class Lists {
    constructor() {
    }

    eventGetList() {
        let result = this.getList();
    }

    getList() {
        $.ajax({
            url: 'http://test-todolist.local/lists',
            type: 'GET',
            success(res) {
                console.log(res);
            }
        });
    }
}