-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Abr-2020 às 09:36
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_laravel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `nome`, `descricao`) VALUES
(1, 'Professores', 'Despertar interesse e inflamar o entusiasmo é o caminho certo para ensinar facilmente e com sucesso.'),
(2, 'Barbeiros', 'Somos barbeiros não pelo o que queremos ter, mas pelo o que a barbearia nos faz ser.'),
(3, 'Motorista', 'Na vida, tudo e passageiro, menos o cobrador e o motorista.'),
(9, 'Fisiculturistas', 'Comer, Treinar e Dormir.'),
(10, 'Leitores', 'Hoje um leitor, amanhã um líder.'),
(11, 'Lutadores', 'Ninguém vai bater mais forte do que a vida. Não importa como você bate e sim o quanto aguenta apanhar e continuar lutando; o quanto pode suportar e seguir em frente. É assim que se ganha.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_13_175208_create_grupos_table', 1),
(5, '2020_04_13_175319_create_pessoas_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` text NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `cidade` text NOT NULL,
  `bairro` text NOT NULL,
  `logradouro` text NOT NULL,
  `numero` text NOT NULL,
  `complemento` text DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `telefone_2` varchar(45) NOT NULL,
  `nacionalidade` varchar(45) NOT NULL,
  `data_nascimento` date NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `cpf`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`, `telefone`, `telefone_2`, `nacionalidade`, `data_nascimento`, `grupo_id`) VALUES
(2, 'Dick Vigarista', '122.632.900-44', '23076-470', 'RJ', 'Rio de Janeiro', 'Campo Grande', 'Rua A', '10', 'Casa', '(21) 92222-2222', '(21) 95466-6666', 'brasileiro', '1990-03-25', 3),
(3, 'Raimundo', '784.653.750-46', '75097-105', 'GO', 'Anápolis', 'Residencial Ayrton Senna', 'Rua San Marino', '53', 'Bloco 2', '(61) 22222-22', '(61) 02154-5454', 'brasileiro', '1992-03-25', 1),
(4, 'Mãos de Tesoura', '141.295.300-62', '59060-126', 'RN', 'Natal', 'Bom Pastor', '10ª Travessa Presidente Castelo Branco', '402', 'Casa 12', '(84) 22214-5555', '(84) 51124-5555', 'brasileiro', '1995-12-03', 2),
(5, 'Girafales', '682.973.300-60', '57246-970', 'AL', 'Roteiro', 'Centro', 'Rua João Pedro, s/n', '502', 'Casa 10', '(82) 12254-5445', '(82) 54654-6456', 'brasileiro', '1975-02-03', 1),
(7, 'Rocky Balboa', '783.988.850-09', '75097-105', 'RJ', 'Rio de Janeiro', 'Taquara', 'André Rocha', '75', 'Ap 203', '(21) 92222-2222', '(21) 95466-6666', 'brasileiro', '1975-02-03', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Albert Alves', 'albertbr2008@gmail.com', NULL, '$2y$10$c37Zs87qya7gOX2xoFKGtu7Y1r5EO9swoTE5i8FZ9ttijvNgEmOEq', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pessoas_grupo_id_foreign` (`grupo_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD CONSTRAINT `pessoas_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
