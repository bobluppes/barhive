var allOrder = new Vue({
    el: '#app',
    data: {
        tickets: [],
        polling: null,
    },

    template: `<div>
                    <template v-for="ticket in tickets">
                        <div class="panel panel-default kitchen-ticket">
                            <div class="panel-heading">
                                <h1>{{ ticket.sName }}</h1>
                            </div>
                            <div class="panel-body">
                                <p>{{ ticket.sComment }}</p>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ new Date(ticket.created_at).getHours() }} : {{ new Date(ticket.created_at).getMinutes() }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Table {{ ticket.iTable }}</h5>
                                    </div>
                                </div>
                                <button class="btn btn-primary" @click="deleteTicket(ticket.id)">Done</button>
                            </div>
                        </div>
                        
                    </template>    
                </div>`,

    methods: {
        pollData() {
            this.polling = setInterval(() => {
                const url = "/api/tickets/all";
                this.$http.get(url).then(response => {
                    this.tickets = response.body;
                });
            }, 1000)
        },

        deleteTicket(id) {
            const url = "/api/tickets/" + id + "/delete";
            this.$http.post(url);
        },

        deleteAll() {
            const url = "/api/tickets/deleteAll";
            this.$http.post(url);
        }
    },

    beforeDestroy () {
        clearInterval(this.polling)
    },

    mounted() {
        const url = "/api/tickets/all";
        this.$http.get(url).then(response => {
            this.tickets = response.body;
        });

        this.pollData();
    }
})