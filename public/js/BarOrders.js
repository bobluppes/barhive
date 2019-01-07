new Vue({
    el: '#app',
    data: {
        tickets: [],
        polling: null,
    },

    template: `<div>
                    <template v-for="ticket in tickets">
                        <div class="card kitchen-ticket">
                            <div class="card-header">
                                <h1>{{ ticket.sName }}</h1>
                            </div>
                            <div class="card-body">
                                <p>{{ ticket.sComment }}</p>
                            </div>
                            <div class="card-footer">
                                <h5>{{ new Date(ticket.created_at).getHours() }} : {{ new Date(ticket.created_at).getMinutes() }}</h5>

                                <button class="btn btn-primary" @click="deleteTicket(ticket.id)">Done</button>
                            </div>
                        </div>
                        
                    </template>    
                </div>`,

    methods: {
        pollData() {
            this.polling = setInterval(() => {
                const url = "/api/bar/tickets";
                this.$http.get(url).then(response => {
                    this.tickets = response.body;
                });
            }, 1000)
        },

        deleteTicket(id) {
            const url = "/api/bar/" + id + "/delete";
            this.$http.post(url);
        }
    },

    beforeDestroy () {
        clearInterval(this.polling)
    },

    mounted() {
        const url = "/api/bar/tickets";
        this.$http.get(url).then(response => {
            this.tickets = response.body;
        });

        this.pollData();
    }
})