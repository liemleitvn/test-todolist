import 'babel-polyfill';

export default class Request {

    /**
     * make query string from params object parameter
     * func encodeURIComponent: encode special characters eg: space - , - / - ? - : - @ .....
     * @param params
     * @param includeQuestionCharacter
     * @returns {string}
     */
    static mapQuery (params = {}, includeQuestionCharacter = false) {
        let esc = encodeURIComponent;

        return (includeQuestionCharacter?'?':'') + Object.keys(params)
            .map(k=>esc(k)+ "=" + esc(params[k]))
            .join('&');
    }

    /**
     * func send request to api url
     * method request: POST
     * @param urlApi = url&path&query_string
     * @param opts = {headers{}&body{}&...}
     * @returns {Promise<any>}
     */
    static async send (urlApi, opts = {}) {

        let headers = Object.assign(opts.headers || {}, {
            'Content-Type': 'application/json'
        });

        let response = await fetch(
            urlApi,
            Object.assign({method: 'POST'}, opts, {headers})
        );


        const data = await response.json();

        console.log(data);

        if(data.error) {
            console.log(data.error);
            return {};
        }


        return data;
    }

    /**
     * method request: GET
     * @param url
     * @param opts
     * @returns {Promise<any>}
     */
    static get(url, opts = {}) {
        return this.send(url, {...opts, method: 'GET'});
    }

}