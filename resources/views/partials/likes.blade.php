<activity-likes 
    login-endpoint="{{ route('login') }}" 
    liked-comments-endpoint="{{ route('profile.likes.comments', $user) }}" 
    liked-articles-endpoint="{{ route('profile.likes.articles', $user) }}"
    articles="{{ __('Articles') }}"
    comments="{{ __('Comments') }}"
></activity-likes>