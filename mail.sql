ALTER TABLE `usuarios` ADD `mail` TEXT NOT NULL AFTER `rol`;
UPDATE `usuarios` SET `mail` = 'p.cardona@joygle.com' WHERE `usuarios`.`id` = 1;
