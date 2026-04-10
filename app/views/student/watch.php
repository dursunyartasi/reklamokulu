<!DOCTYPE html>
<html lang="tr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/style.css') ?>?v=20260410b">
</head>
<body class="watch-page">

<div class="watch-layout">
    <!-- Video Player -->
    <div class="watch-main">
        <div class="watch-header">
            <a href="<?= url('panel') ?>" class="btn btn-sm btn-outline"><i class="fas fa-arrow-left"></i> Panele Dön</a>
            <h2><?= e($course['title']) ?></h2>
        </div>

        <div class="video-player">
            <?php if ($currentLesson && $currentLesson['video_url']):
                $videoUrl = $currentLesson['video_url'];
                $embedUrl = $videoUrl;
                // YouTube URL'sini embed URL'ye cevir
                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $m)) {
                    $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
                }
                // Vimeo URL'sini embed URL'ye cevir
                elseif (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $videoUrl, $m)) {
                    $embedUrl = 'https://player.vimeo.com/video/' . $m[1];
                }
            ?>
                <iframe src="<?= e($embedUrl) ?>"
                        frameborder="0" allowfullscreen
                        allow="autoplay; fullscreen; picture-in-picture"
                        loading="lazy"></iframe>
            <?php else: ?>
                <div class="video-placeholder-big">
                    <i class="fas fa-play-circle fa-4x"></i>
                    <p>Izlemek icin sol taraftan bir ders secin</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($currentLesson): ?>
        <div class="lesson-info-bar">
            <h3><?= e($currentLesson['title']) ?></h3>
            <?php
            $lessonCompleted = false;
            $dbCheck = Database::connect();
            $stmtCheck = $dbCheck->prepare('SELECT is_completed FROM lesson_progress WHERE user_id = ? AND lesson_id = ?');
            $stmtCheck->execute([currentUserId(), $currentLesson['id']]);
            $lessonCompleted = (bool) $stmtCheck->fetchColumn();
            ?>
            <?php if ($lessonCompleted): ?>
                <span class="btn btn-sm" style="background:#d1fae5;color:#065f46;cursor:default;">
                    <i class="fas fa-check-circle"></i> Tamamlandi
                </span>
            <?php else: ?>
                <form action="<?= url('panel/ders-tamamla') ?>" method="POST" class="complete-form">
                    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                    <input type="hidden" name="lesson_id" value="<?= $currentLesson['id'] ?>">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i> Dersi Tamamla
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <?php if ($currentLesson['content']): ?>
        <div class="lesson-content-text">
            <?= $currentLesson['content'] ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Sidebar - Ders Listesi -->
    <aside class="watch-sidebar">
        <div class="watch-sidebar-header">
            <h3>Kurs İçeriği</h3>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= $progress['percentage'] ?>%"></div>
            </div>
            <span class="progress-text-sm">%<?= $progress['percentage'] ?> tamamlandı</span>
        </div>

        <?php
        // Tamamlanan dersleri al
        $completedLessons = [];
        $db = Database::connect();
        $stmtCompleted = $db->prepare('SELECT lesson_id FROM lesson_progress WHERE user_id = ? AND is_completed = 1');
        $stmtCompleted->execute([currentUserId()]);
        $completedLessons = array_column($stmtCompleted->fetchAll(), 'lesson_id');
        ?>
        <div class="watch-curriculum">
            <?php foreach ($sections as $section): ?>
            <div class="watch-section">
                <div class="watch-section-title"><?= e($section['title']) ?></div>
                <?php foreach ($section['lessons'] as $lesson): ?>
                <?php $isCompleted = in_array($lesson['id'], $completedLessons); ?>
                <a href="<?= url('panel/kurs/' . $course['slug'] . '?ders=' . $lesson['id']) ?>"
                   class="watch-lesson <?= ($currentLesson && $currentLesson['id'] == $lesson['id']) ? 'active' : '' ?> <?= $isCompleted ? 'completed' : '' ?>">
                    <i class="fas <?= $isCompleted ? 'fa-check-circle' : 'fa-play-circle' ?>" style="<?= $isCompleted ? 'color:#10b981' : '' ?>"></i>
                    <span class="watch-lesson-title"><?= e($lesson['title']) ?></span>
                    <?php if ($lesson['video_duration']): ?>
                        <span class="watch-lesson-duration"><?= formatDuration($lesson['video_duration']) ?></span>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </aside>
</div>

<script src="<?= url('js/app.js') ?>"></script>
</body>
</html>