import $ from 'jquery';
import 'fullcalendar';
import 'fullcalendar-scheduler';
import Request from './Request'


export default class TasksHandler {
    constructor() {
        this.eventDrop = this.eventDrop.bind(this);
    }

    /**
     * create events from data, then import eventResource to view task
     * @param data
     * @returns {Array}
     */
    mapData(data) {
        let events = [];
        data.map((item) => {

            //status = 1: Planning (background is yellow)
            //status = 2: Doing (background is red)
            //status = 3: Complete (background is green)
            let color = "green";
            if(item.status === 1) {
                color = 'yellow'
            }
            else if(item.status === 2) {
                color = 'red';
            }
            events.push({
                id: item.id,
                title: item.name,
                start: item.start_date,
                end: item.end_date,
                color: color
            });
        });

        return events;
    }

    /**
     * header of calendar
     * @returns {{left: string, center: string, right: string}}
     */
    calendarHeader() {
        return {
            left: 'prev,next today myCustomButton',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        }
    }

    /**
     * function create view
     * @param data
     * @returns {{events: Array, textColor: string}[]}
     */
    eventSources(data) {
        return [
            {
                events: this.mapData(data),
                textColor: 'black' // an option!
            }
        ];
    }

    eventTask() {

        let result = this.getTask();

        result.then((res)=> {
            if(res.data.length > 0) {

                $('#calendar').fullCalendar({
                    droppable: true,
                    editable: true,

                    header: this.calendarHeader(),

                    eventSources: this.eventSources(res.data),

                    eventResize: this.eventResize,

                    eventDrop: this.eventDrop,
                });
            }
        }).catch((error)=> {
            console.log('error: '+error)
        })
    }

    /**
     * update task
     * @param event
     * @param delta
     * @param revertFunc
     */
    eventDrop(event, delta, revertFunc) {
        let end_date = '';

        //the task is 1 day
        if(event.end === null) {
            end_date = event.start.format();
        }
        else {
            end_date = event.end.subtract(1, 'days').format()
        }

        let status = 3;
        let color = event.color;
        if(color==='yellow') {
            status = 1;
        }
        else if(color === 'green') {
            status = 2;
        }

        let task = {
            id: event.id,
            title: event.title,
            start_date: event.start.format(),
            end_date: end_date,
            status: status,
        };

        let result = this.updateTask(task);

        result.then((res)=> {
            console.log(res)
        }).catch((err)=> {
            console.log('error: ' + err)
        })

    }

    eventResize( event, jsEvent, ui, view) {
        let end_date = '';

        //the task is 1 day
        if(event.end === null) {
            end_date = event.start.format();
        }
        else {
            end_date = event.end.subtract(1, 'days').format()
        }

        console.log('resize: '+event.start.format() + '-' + end_date);
    }

    /**
     * get task use ajax
     * @returns {Promise<void>}
     */
    async getTask() {
        let url = 'http://test-todolist.local/tasks';
        return await Request.get(url);

    }

    async updateTask(data) {

        let url = 'http://test-todolist.local/tasks/update';
        let opts = {
            body: JSON.stringify(data)
        };

        return await Request.send(url,opts);
    }
}