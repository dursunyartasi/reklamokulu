<?php $activePanel = 'görüşme'; ?>
<?php require __DIR__ . '/_panel_header.php'; ?>

<section class="section panel-section">
    <div class="container">
        <div class="panel-layout">
            <?php require __DIR__ . '/_sidebar.php'; ?>

            <div class="panel-main">
                <h3 class="panel-title">Bire Bir Görüşme</h3>

                <!-- New Meeting Request -->
                <div class="meeting-info-card">
                    <div class="meeting-info-icon"><i class="fas fa-video"></i></div>
                    <div>
                        <h4>Egitmeninle Bire Bir Görüşme Hakkin Var!</h4>
                        <p>Egitimlerine kayit olduğunda her eğitim için 2x30 dakika ücretsiz bire bir görüşme hakkın bulunmaktadır. Aşağıdan görüşme talebi oluşturabilirsin.</p>
                    </div>
                </div>

                <?php if (!empty($enrolledCourses)): ?>
                <form action="<?= url('panel/gorusme-talebi') ?>" method="POST" class="meeting-form">
                    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Egitim Secin</label>
                            <select name="course_id" required>
                                <option value="">Egitim seçiniz...</option>
                                <?php foreach ($enrolledCourses as $course): ?>
                                    <option value="<?= $course['id'] ?>"><?= e($course['title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tercih Edilen Tarih</label>
                            <input type="date" name="preferred_date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Tercih Edilen Saat</label>
                            <select name="preferred_time" required>
                                <option value="">Saat seçiniz...</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Görüşme Suresi</label>
                            <select name="duration" required>
                                <option value="30">30 Dakika</option>
                                <option value="60">60 Dakika</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Görüşmek İstediğiniz Konu</label>
                        <textarea name="notes" rows="3" placeholder="Görüşmede konusmak istediginiz konuları kisaca yaziniz..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-plus"></i> Görüşme Talebi Olustur
                    </button>
                </form>
                <?php endif; ?>

                <!-- Previous Meetings -->
                <?php if (!empty($meetings)): ?>
                <h3 class="panel-title" style="margin-top: 2.5rem;">Gecmis Görüşmelerim</h3>
                <div class="meetings-list">
                    <?php foreach ($meetings as $meeting): ?>
                    <div class="meeting-card">
                        <div class="meeting-card-left">
                            <div class="meeting-date-badge">
                                <span class="meeting-day"><?= date('d', strtotime($meeting['preferred_date'])) ?></span>
                                <span class="meeting-month"><?= date('M', strtotime($meeting['preferred_date'])) ?></span>
                            </div>
                            <div>
                                <h4><?= e($meeting['course_title']) ?></h4>
                                <p><i class="fas fa-clock"></i> <?= e($meeting['preferred_time']) ?> - <?= $meeting['duration'] ?> dk</p>
                                <?php if ($meeting['notes']): ?>
                                    <p class="meeting-notes"><?= e($meeting['notes']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <span class="meeting-status meeting-status-<?= $meeting['status'] ?>">
                            <?php
                            $statusMap = ['pending' => 'Beklemede', 'approved' => 'Onaylandı', 'completed' => 'Tamamlandı', 'cancelled' => 'İptal'];
                            echo $statusMap[$meeting['status']] ?? $meeting['status'];
                            ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php elseif (empty($enrolledCourses)): ?>
                    <div class="empty-state">
                        <i class="fas fa-comments fa-3x"></i>
                        <h3>Bire Bir Görüşme Icin Egitim Alin</h3>
                        <p>Bir egitime kayit oldugunuzda bire bir görüşme hakkı kazanirsiniz.</p>
                        <a href="<?= url('egitimler') ?>" class="btn btn-primary">Eğitimleri İncele</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
