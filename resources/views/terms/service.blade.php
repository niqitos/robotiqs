@extends('layouts.app')

@section('title', __('Terms of service'))
@section('description', config('app.description'))
@section('author', config('app.author'))
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Пользовательское Соглашение</h1>

            <br>

            <p>Настоящее Пользовательское Соглашение (Далее Соглашение) регулирует отношения между владельцем robotiqs.net (далее Робототехника или Администрация) с одной стороны и пользователем сайта с другой.</p>

            <p>Сайт Робототехника не является средством массовой информации.</p>

            <p>Используя сайт, Вы соглашаетесь с условиями данного соглашения.</p>
            
            <p class="font-weight-bold">Если Вы не согласны с условиями данного соглашения, не используйте сайт Робототехника!</p>

            <br>

            <h2>Предмет соглашения</h2>

            <br>

            <p class="font-weight-bold">Администрация предоставляет пользователю право на размещение на сайте следующей информации:</p>

            <ul>
                <li>Текстовой информации</li>
                <li>Ссылок на материалы, размещенные на других сайтах</li>
            </ul>

            <br>

            <h2>Права и обязанности сторон</h2>

            <br>
            
            <p class="font-weight-bold">Пользователь имеет право:</p>

            <ul>
                <li>осуществлять поиск информации на сайте</li>
                <li>получать информацию на сайте</li>
                <li>создавать информацию для сайта</li>
                <li>распространять информацию на сайте</li>
                <li>комментировать контент, выложенный на сайте</li>
                <li>изменять рейтинг пользователей</li>
                <li>копировать информацию на другие сайты с указанием источника</li>
                <li>требовать от администрации скрытия любой информации о пользователе</li>
                <li>требовать от администрации скрытия любой информации переданной пользователем сайту</li>
                <li>использовать информацию сайта в личных некоммерческих целях</li>
            </ul>

            <p class="font-weight-bold">Администрация имеет право:</p>

            <ul>
                <li>по своему усмотрению и необходимости создавать, изменять, отменять правила</li>
                <li>ограничивать доступ к любой информации на сайте</li>
                <li>создавать, изменять, удалять информацию</li>
                <li>удалять учетные записи</li>
                <li>удалять учетные записи</li>
            </ul>
            
            <p class="font-weight-bold">Пользователь обязуется:</p>
            
            <ul>
                <li>обеспечить достоверность предоставляемой информации</li>
                <li>не создавать несколько учётных записей на Сайте, если фактически они принадлежат одному и тому же лицу</li>
                <li>при копировании информации с других источников, включать в её состав информацию об авторе</li>
                <li>не распространять информацию, которая направлена на пропаганду войны, разжигание национальной, расовой или религиозной ненависти и вражды, а также иной информации, за распространение которой предусмотрена уголовная или административная ответственность </li>
                <li>не совершать действия, направленные на введение других Пользователей в заблуждение</li>
                <li>не размещать материалы рекламного, эротического, порнографического или оскорбительного характера, а также иную информацию, размещение которой запрещено или противоречит нормам действующего законодательства</li>
                <li>не использовать скрипты (программы) для автоматизированного сбора информации и/или взаимодействия с Сайтом и его Сервисами</li>
            </ul>

            <p class="font-weight-bold">Администрация обязуется:</p>

            <ul>
                <li>поддерживать работоспособность сайта за исключением случаев, когда это невозможно по независящим от Администрации причинам.</li>
                <li>осуществлять разностороннюю защиту учетной записи Пользователя</li>
                <li>Защищать информацию, распространение которой ограничено или запрещено законами путем вынесения предупреждения либо удалением учетной записи пользователя, нарушившего правила </li>
            </ul>

            <p class="font-weight-bold">Ответственность сторон</p>

            <ul>
                <li>Пользователь лично несет полную ответственность за распространяемую им информацию</li>
                <li>Администрация не несет никакой ответственности за достоверность информации, скопированной из других источников</li>
                <li>Администрация не несёт ответственность за несовпадение ожидаемых Пользователем и реально полученных услуг</li>
                <li>Администрация не несет никакой ответственности за услуги, предоставляемые третьими лицами</li>
                <li>В случае возникновения форс-мажорной ситуации (боевые действия, чрезвычайное положение, стихийное бедствие и т. д.) Администрация не гарантирует сохранность информации, размещённой Пользователем, а также бесперебойную работу информационного ресурса</li>
            </ul>

            <p class="font-weight-bold">Условия действия Соглашения</p>

            <p>Данное Соглашение вступает в силу при регистрации на сайте.</p>

            <p>Соглашение перестает действовать при появлении его новой версии.</p>

            <p>Администрация оставляет за собой право в одностороннем порядке изменять данное соглашение по своему усмотрению.</p>

            <p>Администрация не оповещает пользователей об изменении в Соглашении.</p>
        </div>
    </div>
@endsection