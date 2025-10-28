<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Recruiting Tech employees for a game development studio">
  <meta name="keywords" content="Tech, Game Development, Careers">
  <meta name="author" content="Phantom Pixel">
  <title>Phantom Pixel</title>

  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/fonts.css">
</head>
<!-- Content including slogans and all the statistics are generated using gen ai. -->
<body id="indexbody"> <!-- Gave it a unique id so that styling would not overlap. -->
    <section id="pageheader">
        <?php include 'header.inc'; ?>
        <?php include 'nav.inc'; ?>
        <h1 id="companytitle">Phantom Pixel</h1>
        <h2 id="slogan">Where Every Pixel Tells a Ghost Story.</h2>
        </header>
    </section>

<!-- Learn about other tags inside <section> tags https://www.mrc-productivity.com/techblog/?ht_kb=css-tutorial-4-div-and-span-tags -->
    <main>
        <h2>Crafting Tomorrow's Gaming Experiences</h2>
        <p>
            At Phantom Pixel, we're a cutting-edge game development studio pushing the boundaries of interactive entertainment. 
            We're rapidly expanding our tech team to bring visionary gaming experiences to life. Join us in creating 
            the next generation of games that captivate players worldwide.
        </p>

        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Talented Developers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Published Games</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5M+</span>
                        <span class="stat-label">Players Worldwide</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Open Positions</span>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="services" >
            <div class="container">
                <h2>What We're Building</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <h3>AAA Game Development</h3>
                        <p>Creating blockbuster gaming experiences using cutting-edge engines like Unreal Engine 5 and Unity. Our team specializes in high-fidelity graphics, immersive storytelling, and innovative gameplay mechanics.</p>
                    </div>
                    <div class="service-card">
                        <h3>Mobile Gaming Platform</h3>
                        <p>Developing next-generation mobile games with cross-platform multiplayer capabilities. We focus on engaging gameplay loops and monetization strategies that delight players.</p>
                    </div>
                    <div class="service-card">
                        <h3>Virtual Reality Experiences</h3>
                        <p>Pioneering immersive VR worlds that transport players to extraordinary realms. Our VR team creates groundbreaking experiences for Meta Quest, PSVR2, and PC platforms.</p>
                    </div>
                    <div class="service-card">
                        <h3>Game Engine Technology</h3>
                        <p>Building proprietary tools and engine modifications to enhance development workflows. Our tech team creates custom solutions for rendering, physics, and AI systems.</p>
                    </div>
                    <div class="service-card">
                        <h3>Live Service Games</h3>
                        <p>Developing and maintaining games-as-a-service with continuous content updates, seasonal events, and community-driven features that keep players engaged long-term.</p>
                    </div>
                    <div class="service-card">
                        <h3>Blockchain Gaming</h3>
                        <p>Exploring the future of gaming with Web3 integration, NFT collectibles, and player-owned economies while maintaining focus on fun and accessibility.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="company-insights" >
            <div class="container">
                <h2>About Phantom Pixel</h2>
                
                <div class="insight-item">
                    <h3>Award-Winning Studio</h3>
                    <p>Phantom Pixel has been recognized with multiple industry awards including "Best Indie Studio" at the Game Developers Choice Awards. Our breakthrough title "Ethereal Realms" won Game of the Year at three major gaming publications.</p>
                </div>

                <div class="insight-item">
                    <h3>Cutting-Edge Technology</h3>
                    <p>We work with the latest technologies including Unreal Engine 5, Unity 2023, and proprietary AI-driven procedural generation tools. Our development pipeline includes modern practices and automated testing frameworks.</p>
                </div>

                <div class="insight-item">
                    <h3>Global Reach</h3>
                    <p>Our games are published across PC, PlayStation, Xbox, Nintendo Switch, iOS, and Android platforms. We have partnerships with major publishers ensuring our titles reach millions of players worldwide.</p>
                </div>
            </div>
        </section>
<!-- Game content and images are generated by ai -->
        <section class="games-showcase">
            <div class="container">
                <h2>Games We Have Developed</h2>
                <div class="games-grid">
                    <div class="game-item">
                        <img src="styles/Images/game-scene.jpg" alt="Ethereal Realms - Adventure Game">
                        <h3>Ethereal Realms</h3>
                        <p>An epic adventure through mystical forests and ancient ruins</p>
                    </div>
                    <div class="game-item">
                        <img src="styles/Images/car-racing.jpg" alt="Speed Circuit - Racing Game">
                        <h3>Speed Circuit</h3>
                        <p>High-octane kart racing with stunning environments</p>
                    </div>
                    <div class="game-item">
                        <img src="styles/Images/shooting.jpg" alt="Warzone Tactics - FPS Game">
                        <h3>Warzone Tactics</h3>
                        <p>Intense tactical shooter with realistic combat mechanics</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
<!-- Footer sections for links to jira, github,etc -->
    <?php include 'footer.inc'; ?>
</body>