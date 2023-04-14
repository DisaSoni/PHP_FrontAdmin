<?php

include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');
$ID = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>

    <link href="styles.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="https://kit.fontawesome.com/672fb65ec9.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <a href="#" class="brand-text">DS<span>.</span></a>

        <div>
            <a href="#about">About</a>
            <a href="#projects">Projects</a>
            <a href="#education">Education</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <header></header>

    <main>
        <h2 id="about">About <span>Me</span></h2>
        <div class="description-container">
            <?php
            $query = 'SELECT *
                  FROM members
                  WHERE id = '.$ID;
            $result = mysqli_query($connect, $query);
            while ($record = mysqli_fetch_assoc($result)) :
            ?>
                <div class="about-description">
                    <p>I'm <em><?php echo $record['first_name'] . ' ' . $record['last_name'] ?></em>,</p>
                    <?php echo $record['description'] ?>
                    <div class="link-container">
                        <a href="<?php echo $record['github']; ?>" class="git-link"><i class="fa-brands fa-github"></i></a>
                        <a href="<?php echo $record['linkedin']; ?>" class="git-link"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            <?php endwhile; ?>

            <h2 id="projects"><span>My</span> Projects</h2>
            <div class="projects-card-container">
                <?php
                $query = 'SELECT projects.id, title, content, photo, url, members.first_name, members.last_name
                  FROM projects
                  LEFT JOIN members ON projects.member_id = members.id
                  ORDER BY date DESC';
                $result = mysqli_query($connect, $query);
                while ($record = mysqli_fetch_assoc($result)) :
                ?>
                    <div class="card-wrapper">
                        <div class="projects-card card">
                            <?php if ($record['photo']) : ?>
                                <img src="<?php echo $record['photo']; ?>" class="project-photo">
                            <?php else : ?>
                                <div class="project-photo">
                                </div>
                            <?php endif; ?>
                            <h3><?php echo $record['title'] ?></h3>
                            <p><?php echo $record['content'] ?></p>
                            <div class="card-bottom">
                                <a href="<?php echo $record['url']; ?>" class="git-link">Github</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>


            <h2 id="education">Education</h2>
            <div class="education-card-container">
                <?php
                $query = 'SELECT *
                        FROM education 
                        where member_id = '.$ID.'
                        ORDER BY end_year DESC';
                $result = mysqli_query($connect, $query);
                while ($record = mysqli_fetch_assoc($result)) :
                ?>
                    <div class="education-card card">
                        <h3><strong><?php echo $record['name'] ?></strong></h3>
                        <p><?php echo $record['degree'] ?></p>
                        <span><em><?php echo $record['start_year'] . ' to ' . $record['end_year'] ?></em></span>
                    </div>
                <?php endwhile; ?>
            </div>
    </main>

    <footer id="contact">
        <div class="separator"></div>
        <a href="#about" class="page-links">About</a>
        <a href="#projects" class="page-links">Projects</a>
        <a href="#education" class="page-links">Education</a>
        <a href="#contact" class="page-links">Contact</a>
        <div class="separator"></div>
        <div class="link-container">
            <?php
            $query = 'SELECT *
                  FROM members
                  WHERE id = '.$ID;
            $result = mysqli_query($connect, $query);
            while ($record = mysqli_fetch_assoc($result)) :
            ?>
                <a href="mailto:<?php echo $record['email']; ?>" class="social-links"><i class="fa-solid fa-envelope"></i></a>
                <a href="tel:<?php echo $record['phone']; ?>" class="social-links"><i class="fa-solid fa-phone"></i></a>
            <?php endwhile; ?>
        </div>
        <p>Copyright &#169; DisaSoni 2023</p>
    </footer>
</body>

</html>