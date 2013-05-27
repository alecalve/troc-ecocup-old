-- Contenu de la table `assos`
--

INSERT INTO `assos` (`nom`) VALUES
('Contact au Mali'),
('Escom'),
('Espéranto'),
('Festupic'),
('Numéo'),
('PAE'),
('Picasso'),
('PMDE'),
('Profit''rôles'),
('Skiutc'),
('UTCéenne'),
('WEI');

--
-- Contenu de la table `ecocups`
--

INSERT INTO `ecocups` (`id`, `asso`, `semestre`, `commentaire`) VALUES
(3, 'Picasso', 'A10', ''),
(4, 'PMDE', 'P10', '25 cl'),
(5, 'Picasso', 'P11', ''),
(6, 'Picasso', 'A11', ''),
(7, 'Picasso', 'P12', ''),
(8, 'Numéo', 'P12', ''),
(9, 'Festupic', 'P12', ''),
(10, 'PMDE', 'P12', ''),
(11, 'WEI', 'A11', ''),
(12, 'WEI', 'A12', ''),
(13, 'WEI', 'A10', '25 cl'),
(14, 'Espéranto', 'A11', 'bleue'),
(15, 'Espéranto', 'P12', 'ESN'),
(16, 'UTCéenne', 'A12', ''),
(17, 'Skiutc', 'P12', ''),
(18, 'Skiutc', 'P13', ''),
(19, 'Picasso', 'A12', ''),
(20, 'Picasso', 'P13', ''),
(21, 'PAE', 'A12', ''),
(22, 'Profit''rôles', 'A12', ''),
(23, 'PMDE', 'P13', '');

--
-- Contenu de la table `semestres`
--

INSERT INTO `semestres` (`semestre`) VALUES
('A10'),
('A11'),
('A12'),
('P10'),
('P11'),
('P12'),
('P13');
