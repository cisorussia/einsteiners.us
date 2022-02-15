@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}/">
    @if(App::isLocale('ru'))
        <meta property="og:title" content="Einsteiners - Сервис организации мероприятий">
        <meta property="og:description" content="Einsteiners - Сервис организации мероприятий">
    @else
        <meta property="og:title" content="Einsteiners - Event Management Service">
        <meta property="og:description" content="Einsteiners - Event Management Service">
    @endif
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('header-style')

@endsection
@section('stylesheet')
    
@endsection
@section('header')
    @if(App::isLocale('ru'))
    <title>О сервисе</title>
    {{--
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
    --}}  
    @else
    <title>About service</title>
    {{--
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
    --}}
    @endif
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="uk-screen uk-screen-page uk-screen-create">
    <div class="uk-container uk-container-center">
        @if(App::isLocale('ru'))
        <h1>О сервисе</h1>
        <p>Einsteiners LLC-это глобальная платформа для проведения мероприятий и мероприятий для детей и взрослых. Мы также проводим занятия по развитию детей в нашем офисе в торговом центре Pheasant Lane Nashua NH.</p>
        <h2>Платформа планирования мероприятий</h2>
        <p>Наша бесплатная онлайн-платформа позволит вам создать свое мероприятие, пригласить друзей и добавить списки пожеланий. Сообщите своим друзьям и семье все подробности вашего мероприятия и проинформируйте всех в одном месте. Легко подсчитать количество гостей и увидеть, кто принял ваше приглашение за считанные секунды, без необходимости совершать какие-либо звонки. Поделитесь ссылкой на свое мероприятие по тексту или электронной почте. Персонализируйте события, добавив изображение и полное описание того, что вы планируете делать, где и в какое время. Если вам нужен аниматор, услуги кейтеринга, фотограф или декоратор - обратитесь за помощью к профессионалам в проведении вашего мероприятия. У нас есть много профессионалов, которые могут помочь, просто дайте нам знать, и мы создадим незабываемое событие для вас, ваших друзей и семьи.</p>
        <p>Вечеринки по случаю дня рождения, выпускной, юбилей и свадьбы - у нас есть опыт во всех из них и многое другое.</p>
        <h2>Классы</h2>
        <p>Наши учителя проводят занятия для детей от 6 месяцев до 20 лет по нашему адресу. Мы полны решимости помочь детям получить разнообразные знания и навыки, соответствующие их возрастной группе.</p>
        <p>Новорожденные начинают учиться с помощью зрения и слуха. Они начинают тянуться к вещам и исследовать окружающие их области. Делая это, они учат и узнают о своем окружении. Их когнитивные знания и развитие мозга также учатся запоминать, думать, реагировать, говорить и рассуждать. Это означает, что они изучают звуки и слова. Дети учатся и знакомятся с базовыми навыками и разработками. Они также учатся/развивают перекатывание, ползание и ходьбу по мере развития их общих двигательных навыков. Их когнитивные знания развиваются в том, как думать, решать проблемы, а также осваивать другие важные навыки. Все эти навыки будут совершенно новыми для малышей, они скоро начнут привыкать к их использованию.</p>
        <h2>Малыши</h2>
        <p>На этом этапе они развивают новые двигательные навыки, когнитивное развитие и языковые навыки. Искусство, музыка, математика и наука помогут развить обе стороны мозга и познать мир вокруг вашего ребенка. Каждый класс будет посвящен не только основной теме, но и другим темам, таким как безопасность и поведение. Каждое занятие будет развивать у детей мелкую и грубую моторику, терпение при сидении и способность концентрироваться на одной задаче в течение длительного периода времени. Наши дети учатся у нас, поэтому мы сделаем все возможное, чтобы показать вашим детям примеры и методы, которым они должны следовать.</p>
        <h2>К-8 (5-12 лет)</h2>
        <p>С момента поступления в школу и до полового созревания дети становятся более самодостаточными. Они осваивают социальные навыки, и некоторые дети уже могут сталкиваться с трудностями в общении по многим причинам. Мы помогаем им избавиться от страха и стать более открытыми не только для своих друзей, но и для членов семьи. Уважение и хорошо развитые навыки слушания являются основой для счастливых отношений. На наших занятиях мы научим детей приобретать эту способность и становиться более уверенными в своих действиях.< / p>
        <h2>Подростки</h2>
        <p>Это самый сложный этап развития детей. Они получили много знаний и с этим начинают учиться на собственном опыте. На этом этапе следует привить здоровые привычки, чтобы помочь вашему ребенку перейти к взрослой жизни. Учась заботиться о себе, они учатся заботиться о других. Важно постоянно обсуждать вопросы секса, ИППП, сексуального насилия и насилия. Задавая трудные вопросы своим детям, вы можете избежать неизбежных последствий. Подростки могут связаться с нашими учителями, чтобы помочь с указаниями по их проблемам.</p>
        @else
        <h1>About service</h1>
        <p>Einsteiners LLC is a global platform for events and activities for kids and adults. We also provide classes for kids' development at our location in Pheasant Lane Mall Nashua NH.</p>
        <h2>The event Planning platform</h2>
        <p>Our free online platform will allow you to create your event, invite friends and add wish lists. Let your friends and family know all the details of your event and update everyone in just one place. It is easy to count the number of guests and see who accepted your invitation in seconds without having to make any calls. Share the link to your event via text or email. Personalize events by adding an image and full description of what you are planning to do, where and at what time. If you need an entertainer, catering services, photographer or decorator - ask for pro's help with your event. We have plenty of professionals that might help, just let us know and we will create an unforgettable event for you and your friends and family.</p>
        <p>Birthday parties, graduation, anniversary and weddings - we have experience in all of them and more.</p>
        <h2>Classes</h2>
        <p>Our teachers are providing classes for kids 6 months to 20 years at our location. We are determined to help kids get a variety of knowledge and skills accommodated by their age group.</p>
        <p>Newborns start learning with their vision and hearing. They start to start reaching out for things and explore the areas around them. By doing this they are teaching and learning about their surroundings. Their cognitive knowledge and brain development are also learning how to memorize, think, respond, speak, and reason. This means that they are learning sounds and words. Kids are learning and being introduced to basic skills and developments. They are are also learning/developing rolling, crawling, and walking as their gross motor skills develop. Their cognitive knowledge is developing on how to think, problem-solve, and also learning other important skills. All of these skills will be brand new to the toddlers, they will soon start getting used to using them.</p>  
        <h2>Toddlers</h2>
        <p>At this stage, they develop new motor skills, cognitive development, and language skills. Art, music, math, and science will help to develop both sides of the brain and learn the world around your kid. Each class will not only focus on the main topic but also on other themes such as security and behavior. Each class will develop kids' fine and gross motor skills, patience for sitting and being able to concentrate on one task for an extended period of time. Our kids learn from us so we will do our best to show your kids examples and practices they should follow.</p>
        <h2>K-8 (5-12 yrs)</h2>
        <p>From starting the school to puberty, kids become more self-sufficient. They learn social skills and some kids might already face difficulties with communication due to many reasons. We help to remove their fear and become more open not only to their friends but to family members. Respect and well-developed listening skills are the basis for a happy relationship. Through our classes, we will teach kids to gain this ability and become more confident in their actions.</p>
        <h2>Teenagers</h2>
        <p>Is the hardest stage of kids' development. They gained a lot of knowledge and with that, they start to learn on hands experience. At this stage, healthy habits should be introduced to help your child transition to adults life. By learning how to take care of themselves - they learn how to take care of others. It is important to have ongoing discussions about sex, STIs, sexual abuse, and assault. By defining difficult questions to your kids you might avoid the unalterable consequences. Teens are welcome to contact our teachers to help with directions with their issues.</p>
        @endif
    </div>
</div>
@endsection