new Vue({
    el: '#app',
    data: {
        tickets: [],
    },

    template: `<div>
                    <template v-for="ticket in tickets">
                        <div class="card">
                            <div class="card-header">
                                <h1>{{ ticket.sName }}</h1>
                            </div>
                            <div class="card-body">
                                <p>{{ new Date(ticket.created_at).getHours() }} : {{ new Date(ticket.created_at).getMinutes() }}</p>
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