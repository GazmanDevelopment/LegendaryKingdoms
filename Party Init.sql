-- Put your user ID here
set @user_id = 1;

INSERT INTO `party` (`id`, `party_name`, `party_silver`, `party_notes`, `current_location`, `user_id`) VALUES
(1, 'My Party', 0, NULL, NULL, @user_id);

INSERT INTO `character_list` (`id`, `name`, `fight_max`, `fight_current`, `stealth_max`, `stealth_current`, `lore_max`, `lore_current`, `survive_max`, `survive_current`, `charisma_max`, `charisma_current`, `health_max`, `health_current`, `armour_current`, `notes`, `party_id`) VALUES
(5, 'Sar Jessica Dayne', 5, 5, 1, 1, 3, 3, 2, 2, 4, 4, 8, 8, 0, NULL, 1),
(6, 'Lord Ti`Quon', 1, 1, 2, 2, 5, 5, 1, 1, 2, 2, 6, 6, 0, NULL, 1),
(7, 'Tasha', 3, 3, 5, 5, 1, 1, 3, 3, 3, 3, 8, 8, 0, NULL, 1),
(8, 'Amelia Pass-Dayne', 3, 3, 2, 2, 2, 2, 3, 3, 1, 1, 6, 6, 0, NULL, 1),
(9, 'Akihiro of Chalice', 4, 4, 3, 3, 2, 2, 5, 5, 1, 1, 8, 8, 0, NULL, 1),
(10, 'Brash', 2, 2, 4, 4, 3, 3, 1, 1, 5, 5, 8, 8, 0, NULL, 1);
