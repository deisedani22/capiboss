<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/auth/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Capiboss</title>
    <meta name="description"
        content="Desperte o protagonismo financeiro desde a infância com as experiências educativas e gamificadas da Capiboss. Soluções para crianças, escolas e professores.">
    <meta name="keywords" content="educação financeira, gamificação, crianças, escolas, startup, capiboss">
    <meta name="author" content="Capiboss">

    <link rel="icon" href="/capiboss/imagens/marca_principal_dourada.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/capiboss/css/style.css">
</head>

<body>

    <!-- ===================== HEADER ===================== -->
    <header class="header">
        <nav class="navbar">
            <a href="#home" class="nav-logo">
                <img src="/capiboss/imagens/logo_capiboss_sem_borda.png" alt="Capiboss Logo" class="logo-img">
            </a>
            <ul class="nav-menu">
                <li><a href="#solutions" class="nav-link">Nossas Soluções</a></li>
                <li><a href="#trilhas" class="nav-link">Trilhas</a></li>
                <li><a href="#plans" class="nav-link">Planos</a></li>
                <li><a href="#about" class="nav-link">Sobre Nós</a></li>
                <li><a href="#contact" class="nav-link">Contato</a></li>
                <?php if (!Auth::estaLogado()): ?>
                    <li><a href="#login" class="nav-link login-btn">Entrar</a></li>
                <?php else: ?>
                    <li><a href="/capiboss/home.php" class="nav-link login-btn">Entrar</a></li>
                <?php endif; ?>
            </ul>
            <div class="hamburger"><span></span><span></span><span></span></div>
        </nav>
    </header>

    <main>
        <?php if (isset($_SESSION['msg'])): ?>
            <section class="session-aviso">
                <div class="textoaviso">
                    <?= $_SESSION['msg'] ?>
                </div>
            </section>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

        <!-- ===================== HERO ===================== -->
        <section id="home" class="hero-section">
            <div class="hero-content">
                <h1>Transforme a educação financeira da sua escola com a <span class="highlight">CAPIBOSS</span>:</h1>
                <p>Educação financeira de forma divertida e criativa.</p>

                <div class="education-icons">
                    <div class="icon-block" data-label="EDUCAÇÃO"><img src="/capiboss/imagens/livro.png" alt="">Educação</div>
                    <span class="symbol">+</span>
                    <div class="icon-block" data-label="GAMIFICAÇÃO"><img src="/capiboss/imagens/controle1.png" alt="">Gamificação</div>
                    <span class="symbol">=</span>
                    <div class="icon-block">
                        <img src="/capiboss/imagens/transformação.png" alt="Transformação">
                        <span class="icon-label">Transformação</span>
                    </div>

                </div>

                <a href="https://api.whatsapp.com/message/75I5DB36HHWNM1?autoload=1&app_absent=0" class="cta-button">Comece Agora</a>

            </div>
            <div class="hero-image">
                <img src="/capiboss/imagens/mascote_pose_pulando.png" alt="Mascote Capiboss" />
            </div>
        </section>
        <section id="solutions" class="solutions-section">


            <!-- ===================== SOLUÇÕES ===================== -->
            <h2 class="section-title">Nossas Soluções</h2>

            <div class="solution-main-content">
                <!-- Mascote -->
                <div class="solution-mascot-container">
                    <img src="/capiboss/imagens/mascote_pose_afirmacao.png" alt="Mascote Capiboss" class="mascot-image">
                </div>

                <!-- Conteúdo principal -->
                <div class="solution-info-container">
                    <p class="solution-description-1">
                        Utilizamos a gamificação para criar experiências educativas que despertam o protagonismo
                        financeiro desde a infância, alinhadas à BNCC.
                        Os alunos aprendem de forma lúdica, professores ganham ferramentas de engajamento e escolas
                        fortalecem sua proposta pedagógica.
                    </p>

                    <div class="solution-cards">
                        <div class="card solution-card card-alunos">
                            <div class="card-icon-placeholder">
                                <img src="/capiboss/imagens/transformação.png" alt="Meu Primeiro Cofrinho">
                            </div>
                            <h3 class="card-title">ALUNOS</h3>
                            <p class="card-text">Aprendem de forma lúdica</p>
                        </div>

                        <div class="card solution-card card-professores">
                            <div class="card-icon-placeholder">
                                <img src="/capiboss/imagens/palmas.png" alt="Professores">
                            </div>
                            <h3 class="card-title">PROFESSORES</h3>
                            <p class="card-text">Ganham ferramentas de engajamento</p>
                        </div>

                        <div class="card solution-card card-escolas">
                            <div class="card-icon-placeholder">
                                <img src="/capiboss/imagens/maos_dinheiro.png" alt="Escolas">
                            </div>
                            <h3 class="card-title">ESCOLAS</h3>
                            <p class="card-text">Fortalecem a proposta pedagógica</p>
                        </div>
                    </div>

                    <p class="solution-description-2">
                        Implemente nossos jogos e transforme a educação financeira em uma jornada interativa e de alto
                        impacto para seus alunos.
                    </p>

                    <a href="https://api.whatsapp.com/message/75I5DB36HHWNM1?autoload=1&app_absent=0" target="_blank" class="cta-button"> Quero na minha escola </a>

                    <!--<button class="cta-button gold solution-cta-button">Quero na minha escola</button>
                       <a href="https://api.whatsapp.com/message/75I5DB36HHWNM1?autoload=1&app_absent=0" class="cta-button">Quero na minha escola</a>-->
                </div>
            </div>
        </section>


        <!-- ===================== TRILHAS ===================== -->
        <section id="trilhas" class="trilhas-section">
            <h2>Trilhas</h2>
            <p class="trilhas-text">Jogos educativos para todas as idades</p>
            <div class="trilhas-grid">
                <div class="trilha-card">
                    <img src="/capiboss/imagens/cofrinho.svg" alt="Meu Primeiro Cofrinho">
                    <h4>Meu Primeiro Cofrinho</h4>
                    <p>Educação Infantil</p>
                    <button class="ver-mais-btn" data-modal="cofrinho">Ver mais</button>
                </div>
                <div class="trilha-card">
                    <img src="/capiboss/imagens/fundamental.svg" alt="Rota das Finanças">
                    <h4>Rota das Finanças</h4>
                    <p>Ensino Fundamental I e II</p>
                    <button class="ver-mais-btn" data-modal="rota">Ver mais</button>
                </div>
                <div class="trilha-card">
                    <img src="/capiboss/imagens/medio.svg" alt="Missão Capiboss">
                    <h4>Missão Capiboss</h4>
                    <p>Ensino Médio</p>
                    <button class="ver-mais-btn" data-modal="missao">Ver mais</button>
                </div>
            </div>

            <p class="trilhas-text">Nunca foi tão divertido e descomplicado aprender sobre finanças!</p>
            <div class="video-wrapper">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/pTGyVpDSVDo?si=8eTl2vpzXoH3gTcO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>

        <!-- ===================== PLANOS ===================== -->
        <section id="plans" class="plans-section">
            <h2 class="section-title">Nossos Planos</h2>
            <p class="trilhas-text">
                Escolha a forma ideal de levar a experiência Capiboss para sua instituição, equipe ou família.
            </p>

            <div class="planos-grid">
                <div class="plano-card">
                    <div class="plano-icon">
                        <img src="/capiboss/imagens/capimoeda_na_mao.png" alt="Ícone Licenciamento">
                    </div>
                    <h4 class="plano-title">Licenciamento</h4>
                    <p class="plano-text">
                        Oferecemos os conteúdos da Capiboss como um recurso educativo licenciado para instituições de
                        ensino.
                    </p>
                    <!-- 🔗 LINK DIRETO PARA WHATSAPP -->
                    <a href="https://wa.me/5598992921537?text=Olá!%20Tenho%20interesse%20no%20Licenciamento%20Capiboss." target="_blank" class="cta-button small"> Contrate Agora </a>
                </div>

                <div class="plano-card">
                    <div class="plano-icon">
                        <img src="/capiboss/imagens/maos_dinheiro.png" alt="Ícone Módulos">
                    </div>
                    <h4 class="plano-title">Módulos</h4>
                    <p class="plano-text">
                        Módulos específicos e personalizáveis que a instituição deseja implementar.
                    </p>
                    <a href="https://wa.me/5598992921537?text=Olá!%20Tenho%20interesse%20no%20Licenciamento%20Capiboss."
                        target="_blank"
                        class="cta-button small">
                        Contrate Agora
                    </a>
                </div>

                <div class="plano-card">
                    <div class="plano-icon">
                        <img src="/capiboss/imagens/palmas.png" alt="Ícone Eventos Educacionais">
                    </div>
                    <h4 class="plano-title">Eventos Educacionais</h4>
                    <p class="plano-text">
                        Eventos exclusivos com Contação de Histórias, Missões, Dinâmicas e Workshops.
                    </p>

                    <!-- 🔗 LINK DIRETO PARA WHATSAPP -->
                    <a href="https://wa.me/5598992921537?text=Olá!%20Quero%20informações%20sobre%20os%20Eventos%20Educacionais%20Capiboss."
                        target="_blank"
                        class="cta-button small">
                        Contrate Agora
                    </a>
                </div>

                <div class="plano-card">
                    <div class="plano-icon">
                        <img src="/capiboss/imagens/controle2.png" alt="Ícone Jogos Capiboss">
                    </div>
                    <h4 class="plano-title">Nossos Jogos</h4>
                    <p class="plano-text">
                        Compre nossos jogos e leve o aprendizado financeiro para o recreio, para casa ou para os amigos!
                    </p>
                    <!-- 🔗 LINK DIRETO PARA WHATSAPP -->
                    <a href="https://wa.me/5598992921537?text=Olá!%20Quero%20informações%20sobre%20os%20Eventos%20Educacionais%20Capiboss."
                        target="_blank"
                        class="cta-button small">
                        Contrate Agora
                    </a>
                </div>
            </div>
        </section>


        <!-- ===================== CADASTRO ===================== -->
        <section id="cadastro" class="cadastro-section">
            <h2 class="section-title">Cadastre-se</h2>

            <form id="cadastroForm"
                action="/capiboss/controllers/salvar_cadastro.php"
                method="POST">
                <div class="form-grid">
                    <!-- Coluna esquerda -->
                    <div class="form-column">
                        <label for="nome">Nome completo*</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

                        <label for="email">E-mail*</label>
                        <input type="email" id="email" name="email" placeholder="Insira um e-mail válido" required>

                        <label for="senha">Senha*</label>
                        <input type="password" id="senha" name="senha" placeholder="Crie uma senha segura (mínimo 6 caracteres)" minlength="6" required>

                        <label for="confirmar-senha">Confirmar senha*</label>
                        <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Repita a senha para confirmar" minlength="6" required>
                    </div>

                    <!-- Coluna direita -->
                    <div class="form-column">
                        <label for="codigo">Código*</label>
                        <input type="text" id="codigo" name="codigo" placeholder="Informe o código da instituição" required>

                        <!-- <label>Tipo de usuário*</label>
                        <div class="radio-group">
                            <label><input type="radio" name="tipo_usuario" value="aluno" required> Aluno(a)</label><br>
                            <label><input type="radio" name="tipo_usuario" value="professor"> Professor(a)</label><br>
                        </div> -->

                        <label for="telefone">Telefone/WhatsApp*</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                    </div>
                </div>

                <button type="submit" class="cta-button gold cadastro-btn">Cadastrar</button>
            </form>
        </section>

        <!-- ===================== SOBRE NÓS ===================== -->
        <section id="about" class="about-section">
            <div class="about-container">
                <!-- Mascote à esquerda -->
                <div class="about-image">
                    <img src="/capiboss/imagens/marca_principal_dourada.png" alt="Mascote na moeda" />
                </div>

                <!-- Texto à direita -->
                <div class="about-content">
                    <h2 class="section-title">Sobre Nós</h2>
                    <h3 class="subtitle">Quem somos?</h3>
                    <p class="about-text">
                        A <strong>Capiboss</strong> é uma plataforma de aprendizado de educação financeira que utiliza métodos
                        <strong>gamificados</strong> para ensinar diversas variedades de conceitos e habilidades relacionadas ao
                        <strong>gerenciamento de dinheiro, investimentos e planejamento financeiro</strong>.
                        <br><br>
                        Os jogadores aprendem o vocabulário financeiro relevante, incluindo termos como <em>cashback</em>, <em>PIB</em>,
                        <em>crédito consignado</em> e muito mais.
                    </p>
                </div>
            </div>

            <!-- Parceiros -->
            <div class="partners-section">
                <h3 class="partners-title">Parceiros e incubadoras</h3>
                <div class="partners-logos">
                    <img src="/capiboss/imagens/fapema.png" alt="FAPEMA" />
                    <img src="/capiboss/imagens/logo_startup_ne.png" alt="Startup Nordeste" />
                    <img src="/capiboss/imagens/marandu.png" alt="Marandu" />
                    <img src="/capiboss/imagens/logo_sebrae-removebg-preview.png" alt="SEBRAE" />
                </div>
            </div>
        </section>



        <!-- ===================== CONTATO ===================== -->
        <section id="contact" class="contact-section">
            <h2>Contatos</h2>
            <p class="trilhas-text">Conecte-se e vamos juntos transformar o futuro!</p>
            <div class="social-icons">
                <a href="https://www.instagram.com/capiboss__/" target="_blank"><img src="/capiboss/imagens/instagram.png"
                        alt="Instagram"></a>
                <a href="https://www.linkedin.com/company/capiboss/?viewAsMember=true" target="_blank"><img
                        src="/capiboss/imagens/LinkedIn.png" alt="LinkedIn"></a>
                <a href="#" target="_blank"><img src="/capiboss/imagens/tiktok.png" alt="TikTok"></a>
                <a href="https://api.whatsapp.com/message/75I5DB36HHWNM1?autoload=1&app_absent=0" target="_blank"><img src="/capiboss/imagens/whasapp.png"
                        alt="WhatsApp"></a>
            </div>
        </section>

        <?php
        if (!Auth::estaLogado()):
        ?>
            <!-- ===================== LOGIN ===================== -->
            <section id="login" class="login-section">
                <h2 class="section-title">Acesse sua Conta</h2>

                <form id="loginForm" action="/capiboss/controllers/login_controller.php" method="POST">
                    <input type="email" name="email" id="email" placeholder="Seu E-mail" required>
                    <input type="password" name="senha" id="password" placeholder="Sua Senha" required>

                    <button type="submit" class="btn-login primary">Entrar</button>
                    <a href="#cadastro" class="btn-login secondary">Cadastrar-se</a>
                </form>
            </section>

        <?php
        else:
        ?>
            <section id="login" class="login-section">
                <a href="/capiboss/controllers/logout.php" class="btn-login secondary">Sair</a>
            </section> <!-- add panel de controle aqui -->
        <?php
        endif;
        ?>

    </main>
    <!-- ===================== FOOTER ===================== -->
    <footer class="footer">
        <p>© 2025 CAPIBOSS INOVA SIMPLES (I.S.) | CNPJ: 60.445.198/0001-49</p>
        <div class="footer-socials">
            <a href="https://www.instagram.com/capiboss__/">Instagram</a>
            <a href="https://www.linkedin.com/company/capiboss/?viewAsMember=true">LinkedIn</a>
            <a href="https://wa.me/5598982759907">WhatsApp</a>
        </div>
    </footer>

    <!-- ===================== MODAL ===================== -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h3 id="modal-title"></h3>
            <p id="modal-text"></p>
        </div>
    </div>
</body>

</html>