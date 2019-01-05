new Vue({
    el: '#app',
    data: {
        tickets: [],
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

                                <form :action="'/api/kitchen/' + ticket.id + '/delete'" method="post">
                                    <button type="submit" class="btn btn-primary">Done</button>
                                </form>
                            </div>
                        </div>
                        
                    </template>    
                </div>`,

    mounted() {
        const url = "/api/kitchen/tickets";
        this.$http.get(url).then(response => {
            this.tickets = response.body;
        });
    }
})