<div class="space-y-8" x-data="{
    comments: [],
    newCommentBody: '',
    error: '',

    init() {
         Alpine.store('commentCount', { value: 0 }); 
        this.fetchComments();

    },

    fetchComments() {
        const url = `/posts/{{ $post->id }}/comments`;
        
        axios.get(url)
            .then(response => {
                this.comments = response.data.comments || [];
                  Alpine.store('commentCount').value = this.comments.length;
                console.log(this.comments.length)
            })
            .catch((error) => {
                console.error(error); // Veja o erro completo
                this.error = 'Erro ao carregar comentários.';
            });
    },

    submitComment() {
        if (!this.newCommentBody.trim()) return;

        axios.post(`/posts/{{ $post->id }}/comments`, {
                body: this.newCommentBody
            })
            .then(response => {
                this.comments.unshift(response.data.comment);
                
                this.newCommentBody = '';
                this.error = '';
                this.fetchComments();
                Alpine.store('commentCount').value++;
                
            })
            .catch((error) => {
                if (error.response?.status === 422) {
                    this.error = error.response.data.errors.body[0];
                } else {
                    this.error = 'Não foi possível enviar o comentário.';
                }
            });
    }
}" x-init="init()" x-cloak>

    <!-- Formulário de Comentário -->
    @auth
        <div class="bg-gray-50 rounded-lg p-6">
            <form @submit.prevent="submitComment">
                <textarea x-model="newCommentBody" rows="3"
                    class="w-full border-gray-200 rounded-lg shadow-sm focus:border-primary focus:ring-primary"
                    placeholder="Escreva seu comentário..."></textarea>

                <div class="mt-4 flex items-center justify-between">
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors"
                        :disabled="!newCommentBody.trim()">
                        Comentar
                    </button>

                    <span x-show="error" x-text="error" class="text-red-600 text-sm"></span>
                </div>
            </form>
        </div>
    @endauth

    <!-- Lista de Comentários -->
    <div class="space-y-6">
        <template x-for="comment in comments" :key="comment.id">
            <div class="flex gap-4">
                <!-- Avatar do Usuário -->
                <div class="flex-shrink-0">
                    <img
                        :src="comment.user?.image ||
                            'https://ui-avatars.com/api/?name=' + encodeURIComponent(comment.user?.name)"
                         :alt="comment.user?.name"
                         class="w-12 h-12 rounded-full object-cover border-2 border-primary/20">
                </div>

                <!-- Conteúdo do Comentário -->
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="font-medium text-gray-900" x-text="comment.user?.name"></span>
                        <span class="text-gray-500 text-sm">•</span>
                        <time class="text-gray-500 text-sm"
                        x-text="comment.created_at 
                        ? new Date(comment.created_at).toLocaleString('pt-BR', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        }) 
                        : ''"></time>
                </div>
                <p class="text-gray-700" x-text="comment.body"></p>
            </div>
    </div>
    </template>

    <!-- Estado Vazio -->
    <template x-if="comments.length === 0">
        <div class="text-center py-6 text-gray-500">
            Nenhum comentário ainda. Seja o primeiro a comentar!
        </div>
    </template>
</div>
</div>
