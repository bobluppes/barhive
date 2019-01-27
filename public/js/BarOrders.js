var barOrder = new Vue({
    el: '#app',
    data: {
        tickets: [],
        polling: null,
    },

    template: `<div class="row d-flex align-items-stretch">
                    <template v-for="ticket in tickets">
                        <div class="col-md-4">
                            <div class="panel panel-primary kitchen-ticket">
                            <div class="panel-heading">
                                <h1>{{ ticket.sName }}</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Table <strong>{{ ticket.iTable }}</strong></h5>
                                        <h5>Ordered: <strong>{{ new Date(ticket.created_at).getHours() }} : {{ new Date(ticket.created_at).getMinutes() }}</strong></h5>
                                    </div>
                                </div>
                                <p>{{ ticket.sComment }}</p>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-lg btn-primary" @click="deleteTicket(ticket.id)">Done</button>
                                <button class="btn btn-lg btn-outline btn-danger" @click="deleteTicket(ticket.id)">Cancel</button>
                            </div>
                        </div>
                        </div>
                    </template>    
                </div>`,

    methods: {
        pollData() {
            this.polling = setInterval(() => {
                const url = "/api/tickets/bar";
                this.$http.get(url).then(response => {
                    this.tickets = response.body;
                });
            }, 1000)
        },

        deleteTicket(id) {
            const url = "/api/tickets/" + id + "/delete";
            this.$http.post(url);
        },

        deleteAllBar() {
            const url = "/api/tickets/deleteAllBar";
            this.$http.post(url);
        }
    },

    beforeDestroy () {
        clearInterval(this.polling)
    },

    mounted() {
        const url = "/api/tickets/bar";
        this.$http.get(url).then(response => {
            this.tickets = response.body;
        });

        this.pollData();
    }
})