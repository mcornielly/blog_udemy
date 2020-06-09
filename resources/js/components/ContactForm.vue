<template>
    <div class="form-contact">
        <transition name="fade" mode="out-in">
        <p v-if="sent">Tú mensaje ha sido recibido te contactaremos pronto.</p>
        <form v-else @submit.prevent="submit">
            <div class="input-container container-flex space-between">
                <input v-model="form.name" v-onkeyup.enter="di(form.name)" type="text" placeholder="Tú Nombre" class="input-name" required>
                <input v-model="form.email" type="email" placeholder="Email" class="input-email" required>
            </div>
            <div class="input-container">
                <input v-model="form.subject" type="text" placeholder="Asunto" class="input-subject" required>
            </div>
            <div class="input-container">
                <textarea v-model="form.message" cols="30" rows="10" placeholder="Tú Mensaje" required></textarea>
            </div>
            <div class="send-message">
                <button class="text-uppercase c-green" :disabled="working">
                    <span v-if="working">Enviando...</span>
                    <span v-else>Enviar Mensaje</span>
                </button>
            </div>
        </form>
        </transition>
        <pre>{{ form }}</pre>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                sent: false,
                working:false,
                form:{
                    name: 'Miguel Angel',
                    email: 'mcornielly@gmail.com',
                    subject: 'Prueba de Test',
                    message: 'Es una prubes' 
                }
            }
        },
        methods:{
            di(value){
              console.log(value)  
              alert(value);
            },
            submit(){
                this.working = true;
                axios.post('/api/messages', this.form).then(res => {
                    this.sent = true;
                    this.working = false;
                }).catch(err => {
                    this.sent = false;
                    this.working = false;
                })
            }
        }
    
    }
</script>
