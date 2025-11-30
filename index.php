<?php
// обработка формы подписки
$message = '';
$message_type = '';

// проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
  $email = trim($_POST['email']);

  // проверяем email на валидность
  if (empty($email)) {
    $message = "пожалуйста, введите email адрес";
    $message_type = "error";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "пожалуйста, введите правильный email адрес";
    $message_type = "error";
  } else {
    // отправляем письмо в облако beget
    $to = "admin@" . $_SERVER['HTTP_HOST'];
    $subject = "новая подписка с сайта Monstera Leafs";
    $body = "новый пользователь подписался на рассылку:\n\nemail: " . $email . "\n\nвремя: " . date('Y-m-d H:i:s');
    $headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
      $message = "спасибо за подписку! ваша почта сохранена";
      $message_type = "success";
    } else {
      $message = "произошла ошибка при сохранении. попробуйте еще раз";
      $message_type = "error";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <section class="monstera-leafs">
    <div class="featured-image fade-in">
      <p class="featured-image__subtitle">MONSTERA LEAFS</p>
      <p class="featured-image__text">Vestibulum sit amet urna turpis. Mauris euismod elit et nisi ultrices,
        ut
        faucibus orci tincidunt</p>
    </div>
    <nav class="icons-nav">
      <ul class="icons-nav__list">
        <li class="icons-nav__item">
          <img src="img/icon_clock.svg" height="16px" width="16px" />
          <p class="icons-nav__value">1/400s</p>
        </li>
        <li class="icons-nav__item">
          <img src="img/icon_focus.svg" height="16px" width="16px" />
          <p class="icons-nav__value">f/3,5</p>
        </li>
        <li class="icons-nav__item">
          <img src="img/icon_iso.svg" height="16px" width="32px" />
          <p class="icons-nav__value">100</p>
        </li>
        <li class="icons-nav__item">
          <img src="img/icon_mark.svg" height="16px" width="10px" />
          <p class="icons-nav__value">Costa Rica</p>
        </li>
      </ul>
    </nav>
  </section>

  <!-- секция с формой подписки -->
  <section class="subscription-section fade-in">
    <h2 class="subscription-title">понравились наши работы?</h2>
    <p class="subscription-subtitle">оставьте свой email и мы свяжемся с вами</p>

    <form class="subscription-form" method="POST" action="">
      <input type="email" name="email" class="subscription-input" placeholder="ваш email адрес" required>
      <button type="submit" class="subscription-btn">подписаться</button>
    </form>

    <?php if (!empty($message)): ?>
      <div class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="past-clients">
    <div class="past-clients__header fade-in">
      <h2 class="past-clients__title">Past clients</h2>
      <h3 class="past-clients__subtitle">Trusted by your favourite companies</h3>
    </div>

    <div class="past-clients__logos fade-in">
      <div class="past-clients__logo-item">
        <img src="img/hill_hayes_logo.svg" alt="Hill Playes" width="128px" height="30px">
      </div>
      <div class="past-clients__logo-item">
        <img src="img/riksgransen_logo.svg" alt="Riksgransen" width="128px" height="78px">
      </div>
      <div class="past-clients__logo-item">
        <img src="img/studio_kai_logo.svg" alt="Studio Cai" width="128px" height="20px">
      </div>
      <div class="past-clients__logo-item">
        <img src="img/chill_industries_logo.svg" alt="Chill Industries" width="128px" height="36px">
      </div>
      <div class="past-clients__logo-item">
        <img src="img/stockholm_logo.svg" alt="Stockholm" width="128px" height="32px">
      </div>
    </div>
  </section>

  <!-- кнопка "наверх" -->
  <button class="scroll-to-top" id="scrollToTop">↑</button>

  <script src="script.js"></script>
</body>

</html>