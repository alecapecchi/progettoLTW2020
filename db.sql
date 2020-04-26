--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-26 19:33:52

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2856 (class 1262 OID 16575)
-- Name: ent_factory; Type: DATABASE; Schema: -; Owner: ale
--

CREATE DATABASE ent_factory WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252' TABLESPACE = tablespace_ale;


ALTER DATABASE ent_factory OWNER TO ale;

\connect ent_factory

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 6 (class 2615 OID 16576)
-- Name: ef_schema; Type: SCHEMA; Schema: -; Owner: ale
--

CREATE SCHEMA ef_schema;


ALTER SCHEMA ef_schema OWNER TO ale;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 16577)
-- Name: cliente; Type: TABLE; Schema: ef_schema; Owner: ale
--

CREATE TABLE ef_schema.cliente (
    username character varying(25) NOT NULL,
    nome character varying(40) NOT NULL,
    cognome character varying(40) NOT NULL,
    email character varying(50) NOT NULL,
    pw character varying(70) NOT NULL,
    score smallint
);


ALTER TABLE ef_schema.cliente OWNER TO ale;

--
-- TOC entry 207 (class 1259 OID 16600)
-- Name: cliente_ordine; Type: TABLE; Schema: ef_schema; Owner: ale
--

CREATE TABLE ef_schema.cliente_ordine (
    username_cliente character varying(25) NOT NULL,
    codice_ordine integer NOT NULL
);


ALTER TABLE ef_schema.cliente_ordine OWNER TO ale;

--
-- TOC entry 205 (class 1259 OID 16589)
-- Name: ordine; Type: TABLE; Schema: ef_schema; Owner: ale
--

CREATE TABLE ef_schema.ordine (
    codice integer NOT NULL,
    corrente boolean NOT NULL,
    indirizzo character varying(60) NOT NULL,
    citta character varying(30) NOT NULL,
    cap character varying(10) NOT NULL,
    nazione character varying(20) NOT NULL
);


ALTER TABLE ef_schema.ordine OWNER TO ale;

--
-- TOC entry 204 (class 1259 OID 16587)
-- Name: ordine_codice_seq; Type: SEQUENCE; Schema: ef_schema; Owner: ale
--

CREATE SEQUENCE ef_schema.ordine_codice_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ef_schema.ordine_codice_seq OWNER TO ale;

--
-- TOC entry 2857 (class 0 OID 0)
-- Dependencies: 204
-- Name: ordine_codice_seq; Type: SEQUENCE OWNED BY; Schema: ef_schema; Owner: ale
--

ALTER SEQUENCE ef_schema.ordine_codice_seq OWNED BY ef_schema.ordine.codice;


--
-- TOC entry 208 (class 1259 OID 16615)
-- Name: ordine_prodotto; Type: TABLE; Schema: ef_schema; Owner: ale
--

CREATE TABLE ef_schema.ordine_prodotto (
    codice_prodotto character varying(10) NOT NULL,
    codice_ordine integer NOT NULL,
    quantita smallint NOT NULL
);


ALTER TABLE ef_schema.ordine_prodotto OWNER TO ale;

--
-- TOC entry 206 (class 1259 OID 16595)
-- Name: prodotto; Type: TABLE; Schema: ef_schema; Owner: ale
--

CREATE TABLE ef_schema.prodotto (
    codice character varying(10) NOT NULL,
    nome character varying(100) NOT NULL,
    categoria character varying(25) NOT NULL,
    prezzo numeric(7,2) NOT NULL,
    foto character varying(50) NOT NULL,
    quantita_mag smallint NOT NULL
);


ALTER TABLE ef_schema.prodotto OWNER TO ale;

--
-- TOC entry 2704 (class 2604 OID 16592)
-- Name: ordine codice; Type: DEFAULT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.ordine ALTER COLUMN codice SET DEFAULT nextval('ef_schema.ordine_codice_seq'::regclass);


--
-- TOC entry 2845 (class 0 OID 16577)
-- Dependencies: 203
-- Data for Name: cliente; Type: TABLE DATA; Schema: ef_schema; Owner: ale
--

INSERT INTO ef_schema.cliente (username, nome, cognome, email, pw, score) VALUES ('prova', 'nome prova', 'cog nome', 'prova@gmail.com', 'pass_prova', NULL);


--
-- TOC entry 2849 (class 0 OID 16600)
-- Dependencies: 207
-- Data for Name: cliente_ordine; Type: TABLE DATA; Schema: ef_schema; Owner: ale
--

INSERT INTO ef_schema.cliente_ordine (username_cliente, codice_ordine) VALUES ('prova', 1);


--
-- TOC entry 2847 (class 0 OID 16589)
-- Dependencies: 205
-- Data for Name: ordine; Type: TABLE DATA; Schema: ef_schema; Owner: ale
--

INSERT INTO ef_schema.ordine (codice, corrente, indirizzo, citta, cap, nazione) VALUES (1, true, 'viale dei ciliegi 17', 'London', '5678', 'UK');
INSERT INTO ef_schema.ordine (codice, corrente, indirizzo, citta, cap, nazione) VALUES (2, true, 'via bla 14', 'Roma', '00100', 'Italia');


--
-- TOC entry 2850 (class 0 OID 16615)
-- Dependencies: 208
-- Data for Name: ordine_prodotto; Type: TABLE DATA; Schema: ef_schema; Owner: ale
--

INSERT INTO ef_schema.ordine_prodotto (codice_prodotto, codice_ordine, quantita) VALUES ('a5', 1, 3);
INSERT INTO ef_schema.ordine_prodotto (codice_prodotto, codice_ordine, quantita) VALUES ('t04', 1, 2);
INSERT INTO ef_schema.ordine_prodotto (codice_prodotto, codice_ordine, quantita) VALUES ('t12', 2, 1);


--
-- TOC entry 2848 (class 0 OID 16595)
-- Dependencies: 206
-- Data for Name: prodotto; Type: TABLE DATA; Schema: ef_schema; Owner: ale
--

INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e2', 'UBTECH Alpha 1 Pro', 'Elettronica', 399.00, 'alpha1.png', 600);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e4', 'EPIKGO Hoverboard', 'Elettronica', 139.00, 'hoverboard.png', 270);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e5', 'Nintento Switch', 'Elettronica', 149.00, 'nintendo.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t11', 'Rubik''s Cube', 'Tavolo', 14.00, 'rubik.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t12', 'Abalone', 'Tavolo', 34.00, 'abalone.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l5', 'Ellie the Sheep', 'Legno', 12.00, 'ellie.png', 1000);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a2', 'Trampoline Plus', 'Action', 200.00, 'trampoline.png', 23);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a5', 'Star Wars Jedi''s Lightsaber', 'Action', 15.00, 'lightsaber.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a6', 'Playmobil Pirates'' Ship', 'Action', 30.00, 'playmobil.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b2', 'Sam doll', 'Bambole', 24.00, 'sam.png', 438);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b3', 'Blaire doll', 'Bambole', 24.00, 'blaire.png', 959);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b4', 'Trolls Poppy Glamour', 'Bambole', 20.00, 'trolls.png', 235);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b6', 'Frozen 2 - Singing Elsa', 'Bambole', 50.00, 'elsa.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t10', 'Starry Night by Vincent Van Gogh 1000 Piece Puzzle', 'Tavolo', 19.00, 'starry_night.png', 45);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l1', 'Wodibow Woonkis', 'Legno', 34.00, 'wodibow_woonkis.png', 57);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l2', 'SolidWorks Wolly', 'Legno', 20.00, 'wolly.png', 984);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l3', 'Speedy Cars', 'Legno', 22.00, 'speedy_cars.png', 43);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l4', 'Happy Plane', 'Legno', 14.00, 'happy_plane.png', 359);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('l6', 'Wooden Helicopter', 'Legno', 16.00, 'wooden_helicopter.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a4', 'Star Wars Action Figures', 'Action', 9.00, 'star_wars.png', 1000);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b1', 'Barbie Dream House', 'Bambole', 240.00, 'barbie_house.png', 832);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('b5', 'Barbie Winter Princess', 'Bambole', 22.00, 'barbie_winter_princess.png', 0);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t01', 'Dixit', 'Tavolo', 29.00, 'dixit.png', 500);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t02', 'Uno', 'Tavolo', 12.00, 'uno.png', 1000);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t03', 'Dobble', 'Tavolo', 14.00, 'dobble.png', 345);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t04', 'Pictionary', 'Tavolo', 29.00, 'pictionary.png', 23);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t08', 'Clue', 'Tavolo', 25.00, 'clue.png', 58);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t09', 'Risiko', 'Tavolo', 33.00, 'risiko.png', 865);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t05', 'Operation', 'Tavolo', 24.00, 'chirurgo.png', 567);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t06', 'Labyrinth', 'Tavolo', 29.00, 'labirinto.png', 456);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('t07', 'Cards Against Humanity', 'Tavolo', 24.00, 'cards.png', 686);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a1', 'Nerf N-Strike Hyper Fire', 'Action', 29.00, 'nerf.png', 534);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('a3', 'Captain America A.F.', 'Action', 9.00, 'avengers.png', 499);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e1', 'Sphero BB-8 Droide', 'Elettronica', 119.00, 'bb8.png', 20);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e3', 'Zivko The Robot', 'Elettronica', 29.00, 'zivko.png', 300);
INSERT INTO ef_schema.prodotto (codice, nome, categoria, prezzo, foto, quantita_mag) VALUES ('e6', 'Mind Designer Robot', 'Elettronica', 32.00, 'clementoni.png', 0);


--
-- TOC entry 2858 (class 0 OID 0)
-- Dependencies: 204
-- Name: ordine_codice_seq; Type: SEQUENCE SET; Schema: ef_schema; Owner: ale
--

SELECT pg_catalog.setval('ef_schema.ordine_codice_seq', 2, true);


--
-- TOC entry 2712 (class 2606 OID 16604)
-- Name: cliente_ordine cliente_ordine_pkey; Type: CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.cliente_ordine
    ADD CONSTRAINT cliente_ordine_pkey PRIMARY KEY (codice_ordine, username_cliente);


--
-- TOC entry 2706 (class 2606 OID 16581)
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (username);


--
-- TOC entry 2708 (class 2606 OID 16594)
-- Name: ordine ordine_pkey; Type: CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.ordine
    ADD CONSTRAINT ordine_pkey PRIMARY KEY (codice);


--
-- TOC entry 2714 (class 2606 OID 16619)
-- Name: ordine_prodotto ordine_prodotto_pkey; Type: CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.ordine_prodotto
    ADD CONSTRAINT ordine_prodotto_pkey PRIMARY KEY (codice_prodotto, codice_ordine);


--
-- TOC entry 2710 (class 2606 OID 16599)
-- Name: prodotto prodotto_pkey; Type: CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.prodotto
    ADD CONSTRAINT prodotto_pkey PRIMARY KEY (codice);


--
-- TOC entry 2715 (class 2606 OID 16605)
-- Name: cliente_ordine codice_ordine; Type: FK CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.cliente_ordine
    ADD CONSTRAINT codice_ordine FOREIGN KEY (codice_ordine) REFERENCES ef_schema.ordine(codice) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2717 (class 2606 OID 16620)
-- Name: ordine_prodotto codice_ordine; Type: FK CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.ordine_prodotto
    ADD CONSTRAINT codice_ordine FOREIGN KEY (codice_ordine) REFERENCES ef_schema.ordine(codice) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2718 (class 2606 OID 16625)
-- Name: ordine_prodotto codice_prodotto; Type: FK CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.ordine_prodotto
    ADD CONSTRAINT codice_prodotto FOREIGN KEY (codice_prodotto) REFERENCES ef_schema.prodotto(codice) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2716 (class 2606 OID 16610)
-- Name: cliente_ordine username_cliente; Type: FK CONSTRAINT; Schema: ef_schema; Owner: ale
--

ALTER TABLE ONLY ef_schema.cliente_ordine
    ADD CONSTRAINT username_cliente FOREIGN KEY (username_cliente) REFERENCES ef_schema.cliente(username) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2020-04-26 19:33:53

--
-- PostgreSQL database dump complete
--

