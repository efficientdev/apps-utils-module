<input id="username" name="username" type="text" x-model="username" @input.debounce.500ms="checkUsername" />

<p x-text="usernameStatus" class="text-sm mt-1"></p>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registerForm', () => ({
            username: '',
            usernameStatus: '',

            async checkUsername() {
                if (this.username.length < 3) {
                    this.usernameStatus = ''
                    return
                }

                const res = await fetch(`/check-username?username=${encodeURIComponent(this.username)}`)
                const data = await res.json()

                this.usernameStatus = data.available
                    ? '✅ Username is available'
                    : '❌ Username is taken'
            }
        }))
    })
</script>
