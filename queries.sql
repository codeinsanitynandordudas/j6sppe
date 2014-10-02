# ==============jogosultsag=========================
SELECT
    u.name 'Felhasználónév',
    r.title 'Jogosultság'
FROM users u
    LEFT JOIN user_roles ur
        ON u.id = ur.user_id
    LEFT JOIN roles r
        ON r.id = ur.role_id
WHERE
    u.id > 0
# ============osszes gyakorlo feladat============
SELECT
    e.title 'Gyakorlat címe',
    q.title 'Gyakorlathoz tartozó kérdés',
    a.value 'Gyakorlathoz tartozó kérdés válasza'
FROM exams e
LEFT JOIN questions q
    ON e.id = q.exam_id
LEFT JOIN answers a
    ON a.exam_id = e.id
# =============helyes valaszok=====================
SELECT
    e.title 'Gyakorlat címe',
    q.title 'Gyakorlathoz tartozó kérdés',
    qa.title 'Gyakorlat kérdésének helyes válasza'
FROM exams e
LEFT JOIN questions q
    ON e.id = q.exam_id
LEFT JOIN question_answers qa
    ON qa.question_id = q.id
# =========felhasznalo gyakorlo feladatai==========
SELECT
    e.title 'Gyakorlat címe',
    ue.percentage 'Gyakorlat értékelése'
FROM user_exams ue
LEFT JOIN exams e
    ON ue.exam_id = e.id
LEFT JOIN users u
    ON u.id = ue.user_id
WHERE
    u.id > 0