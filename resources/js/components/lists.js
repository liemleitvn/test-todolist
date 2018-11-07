export default class Lists {
    constructor() {
    }

    eventGetList() {
        let result = this.getList();

        result.then((res)=> {
            if(res.message) {
                alert(res.message);
            }
            else {
                console.log(res);
            }
        }).catch((error)=> {
            console.log(error)
        })
    }

    async getList() {
        return await $.ajax({
            url: 'http://test-todolist.local/lists',
            type: 'GET',
            success(res) {
                console.log(res);
            }
        });
    }
}