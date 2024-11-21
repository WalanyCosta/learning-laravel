<x-mail::message>
# Correio para a provar

<x-mail::panel>
    Se criou um novo post que necessita ser aprovado.
</x-mail::panel>

<x-mail::button :url="route('posts.show', $post)" color="success">
    Click aqui para aprovar
</x-mail::button>
</x-mail::message>
