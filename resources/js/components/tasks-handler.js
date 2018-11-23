import $ from 'jquery';
import 'fullcalendar';
import 'fullcalendar-scheduler';
import Request from './Request'
import moment from 'moment';
import Toast from '../utils/toast';
import Modal from '../utils/modal';

export default class TasksHandler {
    constructor() {
        this.eventDrop = this.eventDrop.bind(this);
        this.getTaskChange = this.getTaskChange.bind(this);
        this.eventResize = this.eventResize.bind(this);
        this.eventClick = this.eventClick.bind(this);
        this.addTask = this.addTask.bind(this);
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

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     */
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

                    eventClick: this.eventClick,

                    dayClick: this.addTask,
                });
            }
        }).catch((error)=> {
            console.log('error: '+error)
        })
    }

    /**
     * Author: Liem Le <lieleitvn@gmail.com>
     * update task when change start date
     * @param event
     * @param delta
     * @param revertFunc
     */
    eventDrop(event, delta, revertFunc) {

        if(event.color === 'red') {
            alert('You do not edit starting date of task is doing');
            location.reload();
            return false;
        } else if (event.color === 'green') {
            alert('You do not edit starting date of task is complete');
            location.reload();
            return false;
        }

        let start_date = event.start;
        let currentDate = moment();

        if(start_date < currentDate) {
            alert("Event date cannot be the past!");
            location.reload();
            return false;
        }


        let task = this.getTaskChange(event);

        let result = this.updateTask(task);


        result.then((res)=> {
            if(res.data === 1) {
                alert('Task update successful');
                location.reload();
            }
        }).catch((err)=> {
            console.log('error: ' + err)
        })

    }

    /**
     * Author: Liem Le <lieleitvn@gmail.com>
     * Update task when change end date
     * @param event
     * @param jsEvent
     * @param ui
     * @param view
     * @returns {boolean}
     */
    eventResize( event, jsEvent, ui, view) {
        if(event.color === 'green') {
            alert('You do not edit ending date of task was complete');
            location.reload();
            return false;
        }


        let task = this.getTaskChange(event);

        let result = this.updateTask(task);


        result.then((res)=> {
            if(res.data === 1) {
                alert('Task update successful');
                location.reload();
            }
        }).catch((err)=> {
            console.log('error: ' + err)
        })
    }

    /**
     * event click on task
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param event
     * @param jsEvent
     * @param view
     */
    eventClick(event, jsEvent, view) {
        let self = this;

        let task = this.getTaskChange(event);
        let body = `<div class="form-group row">
            <div class="col-3">
            <label for="text" class="col-form-label">Name: </label>
            </div>
            <div class="col-9">
            <input type="text" class="form-control" id="name" value="${task.name}"/></div>
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="select" class="col-form-label">Status</label>
            </div>
            <div class="col-9">
            <select id="status" class="form-control" >
                <option value=""></option>
                <option value="1"${task.status === 1 ? ' selected': ''}>Planning</option>
                <option value="2"${task.status === 2 ? ' selected': ''}>Doing</option>
                <option value="3"${task.status === 3 ? ' selected': ''}>Complete</option>
            </select>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="start-date" class="col-form-label">Start date</label>
            </div>
            <div class="col-9">
            <input id="start-date" type="date" class="form-control" value="${task.start_date}">
            </div>
            </div
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="end-date" class="col-form-label">End date</label>
            </div>
            <div class="col-9">
            <input id="end-date" type="date" class="form-control" value="${task.end_date}"/>
            </div>
            </div>`;

        let footer = `<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Save</button>
            <button type="button" class="btn btn-danger" id="delete-task">Delete</button>`;


        Modal.show("Information Task", body, footer, function (modal) {
            let $form = $(modal.element).find("form");

            $(modal.element).on('click', '#delete-task', function () {
                let id_task = task.id;

                let conf = confirm('Do you delete this task ?');
                if(conf) {
                    let result = self.deleteTask(id_task);
                    result.then((res)=> {
                        if(res.data) {
                            modal.hide();
                            alert(`Task ${task.name} is deleted.`);
                            $('#calendar').fullCalendar('refetchEvents',sources);
                        }
                    }).catch((error)=> {
                        console.log(error);
                        modal.hide();
                    })
                }

            });


            // create event handler for form submit and handle values
            $(modal.element).on("submit", "form", function (event) {
                event.preventDefault();
                let $form = $(modal.element).find("form");

                let name = $form.find('#name').val();
                let status = parseInt($form.find('#status').val());
                let start_date = $form.find('#start-date').val();
                let end_date = $form.find('#end-date').val();



                let newTask = {
                    id: task.id,
                    name: name,
                    start_date: start_date,
                    end_date: end_date,
                    status: status,
                };

                if(status<task.status) {
                    Toast.error('You can not switch back to status in which the task was passed');
                    modal.hide();
                    return false
                }

                let result = self.updateTask(newTask);
                result.then((res)=> {
                    if(res.data === 1) {
                        alert('Task update successful');
                        location.reload();
                    }
                }).catch((err)=> {
                    console.log('error: ' + err)
                });
                modal.hide()
            } );
            modal.hide()
        });
    }

    /**
     * click date and add task
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param date
     * @param jsEvent
     * @param view
     * @param resourceObj
     * @returns {boolean}
     */
    addTask (date, jsEvent, view, resourceObj) {
        let clickDate = date;
        let currentDate = moment();

        let self = this;

        if(clickDate < currentDate) {
            Toast.error("Event date cannot be the past!");
            return false;
        }

        clickDate = moment(clickDate).format();

        let body = `<div class="form-group row">
            <div class="col-3">
            <label for="text" class="col-form-label">Name</label>
            </div>
            <div class="col-9">
            <input type="text" class="form-control" id="name"/></div>
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="select" class="col-form-label">Status</label>
            </div>
            <div class="col-9">
            <select id="status" class="form-control">
            <option value="1">Planning</option>
            <option value="2">Doing</option>
            <option value="3">Complete</option>
            </select>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="start-date" class="col-form-label">Start date</label>
            </div>
            <div class="col-9">
            <input id="start-date" type="date" class="form-control" value="${clickDate}" disabled>
            </div>
            </div
            </div>
            <div class="form-group row">
            <div class="col-3">
            <label for="end-date" class="col-form-label">End date</label>
            </div>
            <div class="col-9">
            <input id="end-date" type="date" class="form-control"/>
            </div>
            </div>`;

        let footer = '<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>' +
            '<button type="submit" class="btn btn-primary">Send</button>';


        Modal.show("Create Task", body, footer,function (modal) {
            // create event handler for form submit and handle values
            $(modal.element).on("submit", "form", function (event) {
                event.preventDefault();
                let $form = $(modal.element).find("form");

                let name = $form.find('#name').val();
                let status = parseInt($form.find('#status').val());
                let start_date = $form.find('#start-date').val();
                let end_date = $form.find('#end-date').val();

                if(new Date(start_date).getTime() > new Date(end_date).getTime()) {
                    Toast.error("Event date cannot be the past!");
                    return false;
                }

                let task = {
                    name: name,
                    start_date: start_date,
                    end_date: end_date,
                    status: status,
                };

                let result = self.setTask(task);
                result.then((res)=> {

                    if(res.data.name === task.name) {
                        alert(`Task ${res.data.name} create success full`);
                        location.reload();
                    }
                }).catch((err)=> {
                    console.log('error: ' + err)
                });
                modal.hide()
            } );
            modal.hide()
        });
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param id
     * @returns {Promise<any>}
     */
    async deleteTask(id) {
        let url =`http://test-todolist.local/tasks/delete/${id}`;
        return await Request.get(url);

    }

    /**
     * Author: Liem Le <lieleitvn@gmail.com>
     * Set status when change task
     * @param event
     * @returns {number}
     */
    getStatus(event) {
        let status = 3;
        let color = event.color;
        if(color==='yellow') {
            status = 1;
        }
        else if(color === 'red') {
            status = 2;
        }
        return status;
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * Set task
     * @param event
     * @returns {{id: *, name: (*|string), start_date: (*|string), end_date: (*|string), status: number}}
     */
    getTaskChange(event) {
        return {
            id: event.id,
            name: event.title,
            start_date: moment(event.start).format(),
            end_date: event.end == null? moment(event.start).format():moment(event.end).format(),
            status: this.getStatus(event),
        };
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * get task use ajax
     * @returns {Promise<void>}
     */
    async getTask() {
        let url = 'http://test-todolist.local/tasks';
        return await Request.get(url);

    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param data
     * @returns {Promise<any>}
     */
    async updateTask(data) {

        let url = 'http://test-todolist.local/tasks/update';
        let opts = {
            body: JSON.stringify(data)
        };

        return await Request.send(url,opts);
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param task
     * @returns {Promise<any>}
     */
    async setTask(task) {
        let url = 'http://test-todolist.local/tasks/create';
        let opts = {
            body: JSON.stringify(task)
        };
        return await Request.send(url,opts);
    }
}