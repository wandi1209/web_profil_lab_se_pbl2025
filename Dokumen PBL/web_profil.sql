--
-- PostgreSQL database dump
--

\restrict iYYx6jpcxIbYHrgFzMEBtNSTW2DLN6ly6urMNbUmUVkeeROrtHwapYhTRDUtU9P

-- Dumped from database version 15.14
-- Dumped by pg_dump version 15.14

-- Started on 2025-12-19 09:04:31 WIB

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
-- TOC entry 252 (class 1255 OID 25995)
-- Name: approve_mahasiswa(integer); Type: PROCEDURE; Schema: public; Owner: postgres
--

CREATE PROCEDURE public.approve_mahasiswa(IN p_pendaftar_id integer)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_nama   VARCHAR;
    v_email  VARCHAR;
    v_nim    VARCHAR;
    v_prodi  VARCHAR;
    v_keahl  VARCHAR;
    v_exists INT;
BEGIN
    SELECT nama, email, nim, program_studi, keahlian
      INTO v_nama, v_email, v_nim, v_prodi, v_keahl
      FROM pendaftar
     WHERE id = p_pendaftar_id;

    IF v_nama IS NULL THEN
        RAISE EXCEPTION 'Pendaftar dengan ID % tidak ditemukan.', p_pendaftar_id;
    END IF;

    SELECT id INTO v_exists FROM personil WHERE email = v_email LIMIT 1;
    IF v_exists IS NOT NULL THEN
        RAISE EXCEPTION 'Email % sudah terdaftar di personil.', v_email;
    END IF;

    INSERT INTO personil (nama, kategori, position, email, nidn, pendidikan, keahlian, created_at, updated_at)
    VALUES (v_nama, 'Mahasiswa', 'Anggota', v_email, v_nim, v_prodi, v_keahl, NOW(), NOW());

    UPDATE pendaftar SET status = 'Diterima', updated_at = NOW() WHERE id = p_pendaftar_id;
END;
$$;


ALTER PROCEDURE public.approve_mahasiswa(IN p_pendaftar_id integer) OWNER TO postgres;

--
-- TOC entry 240 (class 1255 OID 25846)
-- Name: update_personil_updated_at(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_personil_updated_at() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_personil_updated_at() OWNER TO postgres;

--
-- TOC entry 239 (class 1255 OID 25820)
-- Name: update_tentang_updated_at(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_tentang_updated_at() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_tentang_updated_at() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 225 (class 1259 OID 25863)
-- Name: album; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.album (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    foto_url character varying(255) NOT NULL,
    kategori character varying(50) DEFAULT 'kegiatan'::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.album OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 25862)
-- Name: album_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.album_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.album_id_seq OWNER TO postgres;

--
-- TOC entry 3858 (class 0 OID 0)
-- Dependencies: 224
-- Name: album_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.album_id_seq OWNED BY public.album.id;


--
-- TOC entry 227 (class 1259 OID 25899)
-- Name: article; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    gambar_url character varying(255),
    ringkasan text,
    content text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    is_featured boolean DEFAULT false,
    author_id integer
);


ALTER TABLE public.article OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 25898)
-- Name: article_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.article_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.article_id_seq OWNER TO postgres;

--
-- TOC entry 3859 (class 0 OID 0)
-- Dependencies: 226
-- Name: article_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.article_id_seq OWNED BY public.article.id;


--
-- TOC entry 233 (class 1259 OID 25960)
-- Name: fokusriset; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fokusriset (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    icon character varying(100) DEFAULT 'bi-diagram-3-fill'::character varying,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.fokusriset OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 25959)
-- Name: fokusriset_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fokusriset_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fokusriset_id_seq OWNER TO postgres;

--
-- TOC entry 3860 (class 0 OID 0)
-- Dependencies: 232
-- Name: fokusriset_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fokusriset_id_seq OWNED BY public.fokusriset.id;


--
-- TOC entry 237 (class 1259 OID 25983)
-- Name: pendaftar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pendaftar (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    no_hp character varying(50),
    nim character varying(50) NOT NULL,
    angkatan character varying(10),
    program_studi character varying(255) NOT NULL,
    portofolio_url character varying(255),
    alasan text NOT NULL,
    status text DEFAULT 'Pending'::text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    peminatan character varying(255),
    keahlian character varying(255),
    catatan text,
    CONSTRAINT pendaftar_status_check CHECK ((status = ANY (ARRAY['Pending'::text, 'Diterima'::text, 'Ditolak'::text])))
);


ALTER TABLE public.pendaftar OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 25850)
-- Name: personil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personil (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    kategori character varying(50) DEFAULT 'dosen'::character varying NOT NULL,
    "position" character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    nidn character varying(50),
    keahlian text,
    pendidikan text,
    linkedin character varying(255),
    github character varying(255),
    foto_url character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    urutan integer DEFAULT 999,
    link_sinta character varying(255) DEFAULT NULL::character varying,
    link_scholar character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.personil OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 25998)
-- Name: mv_admin_stats; Type: MATERIALIZED VIEW; Schema: public; Owner: postgres
--

CREATE MATERIALIZED VIEW public.mv_admin_stats AS
 WITH pendaftar_agg AS (
         SELECT count(*) AS total_pendaftar,
            count(*) FILTER (WHERE (pendaftar.status = 'Pending'::text)) AS pending_count,
            count(*) FILTER (WHERE (pendaftar.status = 'Diterima'::text)) AS diterima_count,
            count(*) FILTER (WHERE (pendaftar.status = 'Ditolak'::text)) AS ditolak_count
           FROM public.pendaftar
        ), pendaftar_year AS (
         SELECT pendaftar.angkatan AS tahun,
            count(*) AS pendaftar_tahun
           FROM public.pendaftar
          WHERE (pendaftar.angkatan IS NOT NULL)
          GROUP BY pendaftar.angkatan
        ), personil_agg AS (
         SELECT count(*) AS total_personil,
            count(*) FILTER (WHERE ((personil.kategori)::text = 'Dosen'::text)) AS dosen_count,
            count(*) FILTER (WHERE ((personil.kategori)::text = 'Mahasiswa'::text)) AS mhs_count,
            count(*) FILTER (WHERE (((personil.kategori)::text <> ALL ((ARRAY['Dosen'::character varying, 'Mahasiswa'::character varying])::text[])) OR (personil.kategori IS NULL))) AS lainnya_count
           FROM public.personil
        )
 SELECT ( SELECT pendaftar_agg.total_pendaftar
           FROM pendaftar_agg) AS total_pendaftar,
    ( SELECT pendaftar_agg.pending_count
           FROM pendaftar_agg) AS pending_count,
    ( SELECT pendaftar_agg.diterima_count
           FROM pendaftar_agg) AS diterima_count,
    ( SELECT pendaftar_agg.ditolak_count
           FROM pendaftar_agg) AS ditolak_count,
    ( SELECT personil_agg.total_personil
           FROM personil_agg) AS total_personil,
    ( SELECT personil_agg.dosen_count
           FROM personil_agg) AS dosen_count,
    ( SELECT personil_agg.mhs_count
           FROM personil_agg) AS mhs_count,
    ( SELECT personil_agg.lainnya_count
           FROM personil_agg) AS lainnya_count
  WITH NO DATA;


ALTER TABLE public.mv_admin_stats OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 25945)
-- Name: password_reset_requests; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_requests (
    id integer NOT NULL,
    user_id integer NOT NULL,
    status character varying(20) DEFAULT 'pending'::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.password_reset_requests OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 25944)
-- Name: password_reset_requests_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.password_reset_requests_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.password_reset_requests_id_seq OWNER TO postgres;

--
-- TOC entry 3861 (class 0 OID 0)
-- Dependencies: 230
-- Name: password_reset_requests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.password_reset_requests_id_seq OWNED BY public.password_reset_requests.id;


--
-- TOC entry 236 (class 1259 OID 25982)
-- Name: pendaftar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pendaftar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pendaftar_id_seq OWNER TO postgres;

--
-- TOC entry 3862 (class 0 OID 0)
-- Dependencies: 236
-- Name: pendaftar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pendaftar_id_seq OWNED BY public.pendaftar.id;


--
-- TOC entry 222 (class 1259 OID 25849)
-- Name: personil_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personil_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personil_id_seq OWNER TO postgres;

--
-- TOC entry 3863 (class 0 OID 0)
-- Dependencies: 222
-- Name: personil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personil_id_seq OWNED BY public.personil.id;


--
-- TOC entry 229 (class 1259 OID 25928)
-- Name: publikasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.publikasi (
    id integer NOT NULL,
    personil_id integer NOT NULL,
    judul character varying(255) NOT NULL,
    tahun integer NOT NULL,
    url character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.publikasi OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 25927)
-- Name: publikasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.publikasi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publikasi_id_seq OWNER TO postgres;

--
-- TOC entry 3864 (class 0 OID 0)
-- Dependencies: 228
-- Name: publikasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.publikasi_id_seq OWNED BY public.publikasi.id;


--
-- TOC entry 215 (class 1259 OID 25628)
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.role OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 25627)
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO postgres;

--
-- TOC entry 3865 (class 0 OID 0)
-- Dependencies: 214
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- TOC entry 235 (class 1259 OID 25972)
-- Name: scope_penelitian; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.scope_penelitian (
    id integer NOT NULL,
    kategori character varying(255) NOT NULL,
    deskripsi text,
    icon_url character varying(255),
    icon_bootstrap character varying(100),
    tags text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.scope_penelitian OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 25971)
-- Name: scope_penelitian_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.scope_penelitian_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scope_penelitian_id_seq OWNER TO postgres;

--
-- TOC entry 3866 (class 0 OID 0)
-- Dependencies: 234
-- Name: scope_penelitian_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.scope_penelitian_id_seq OWNED BY public.scope_penelitian.id;


--
-- TOC entry 221 (class 1259 OID 25823)
-- Name: tentang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tentang (
    id integer NOT NULL,
    judul character varying(200) NOT NULL,
    konten text NOT NULL,
    gambar character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.tentang OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 25822)
-- Name: tentang_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tentang_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tentang_id_seq OWNER TO postgres;

--
-- TOC entry 3867 (class 0 OID 0)
-- Dependencies: 220
-- Name: tentang_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tentang_id_seq OWNED BY public.tentang.id;


--
-- TOC entry 217 (class 1259 OID 25635)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password_hash character varying(100) NOT NULL,
    role_id integer,
    nama_lengkap character varying(255)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 25634)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- TOC entry 3868 (class 0 OID 0)
-- Dependencies: 216
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public.users.id;


--
-- TOC entry 219 (class 1259 OID 25798)
-- Name: visi_misi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visi_misi (
    id integer NOT NULL,
    kategori character varying(10) NOT NULL,
    konten text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT visi_misi_kategori_check CHECK (((kategori)::text = ANY ((ARRAY['visi'::character varying, 'misi'::character varying])::text[])))
);


ALTER TABLE public.visi_misi OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 25797)
-- Name: visi_misi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visi_misi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visi_misi_id_seq OWNER TO postgres;

--
-- TOC entry 3869 (class 0 OID 0)
-- Dependencies: 218
-- Name: visi_misi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visi_misi_id_seq OWNED BY public.visi_misi.id;


--
-- TOC entry 3622 (class 2604 OID 25866)
-- Name: album id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album ALTER COLUMN id SET DEFAULT nextval('public.album_id_seq'::regclass);


--
-- TOC entry 3626 (class 2604 OID 25902)
-- Name: article id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article ALTER COLUMN id SET DEFAULT nextval('public.article_id_seq'::regclass);


--
-- TOC entry 3637 (class 2604 OID 25963)
-- Name: fokusriset id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fokusriset ALTER COLUMN id SET DEFAULT nextval('public.fokusriset_id_seq'::regclass);


--
-- TOC entry 3633 (class 2604 OID 25948)
-- Name: password_reset_requests id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_requests ALTER COLUMN id SET DEFAULT nextval('public.password_reset_requests_id_seq'::regclass);


--
-- TOC entry 3644 (class 2604 OID 25986)
-- Name: pendaftar id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendaftar ALTER COLUMN id SET DEFAULT nextval('public.pendaftar_id_seq'::regclass);


--
-- TOC entry 3615 (class 2604 OID 25853)
-- Name: personil id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil ALTER COLUMN id SET DEFAULT nextval('public.personil_id_seq'::regclass);


--
-- TOC entry 3630 (class 2604 OID 25931)
-- Name: publikasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi ALTER COLUMN id SET DEFAULT nextval('public.publikasi_id_seq'::regclass);


--
-- TOC entry 3608 (class 2604 OID 25631)
-- Name: role id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- TOC entry 3641 (class 2604 OID 25975)
-- Name: scope_penelitian id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scope_penelitian ALTER COLUMN id SET DEFAULT nextval('public.scope_penelitian_id_seq'::regclass);


--
-- TOC entry 3612 (class 2604 OID 25826)
-- Name: tentang id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tentang ALTER COLUMN id SET DEFAULT nextval('public.tentang_id_seq'::regclass);


--
-- TOC entry 3609 (class 2604 OID 25638)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- TOC entry 3610 (class 2604 OID 25801)
-- Name: visi_misi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi ALTER COLUMN id SET DEFAULT nextval('public.visi_misi_id_seq'::regclass);


--
-- TOC entry 3839 (class 0 OID 25863)
-- Dependencies: 225
-- Data for Name: album; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.album (id, judul, deskripsi, foto_url, kategori, created_at, updated_at) FROM stdin;
2	Riset Tim Lab	Progres riset dosen dan mahasiswa di bidang software engineering.	/uploads/album/693627de1bfe5_1765156830.jpg	kegiatan	2025-12-08 08:20:30.116045	2025-12-08 08:20:30.116045
1	Pengembangan Sistem Lab	Pengembangan website, CMS, dan sistem internal Laboratorium SE.	/uploads/album/693628152ec76_1765156885.jpg	kegiatan	2025-12-01 09:25:38.241783	2025-12-08 08:21:25.194262
3	Kelas Industri	Kolaborasi materi industri terkait tools, workflow, dan standar pengembangan.	/uploads/album/6936283ddfeea_1765156925.jpg	workshop	2025-12-08 08:22:05.918274	2025-12-08 08:22:05.918274
4	Praktikum RPL	Dokumentasi praktikum rekayasa perangkat lunak dan pembimbingan asisten.	/uploads/album/693628743acf1_1765156980.jpg	lainnya	2025-12-08 08:23:00.24152	2025-12-08 08:23:00.24152
\.


--
-- TOC entry 3841 (class 0 OID 25899)
-- Dependencies: 227
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.article (id, title, slug, gambar_url, ringkasan, content, created_at, updated_at, is_featured, author_id) FROM stdin;
4	Kabar membanggakan kembali hadir dari mahasiswa Program Studi Sistem Informasi Bisnis	kabar-membanggakan-kembali-hadir-dari-mahasiswa-program-studi-sistem-informasi-bisnis	/uploads/blog/69359bec7ad22_1765121004.jpeg	Malang, 28 November 2025 – Jurusan Teknologi Informasi Politeknik Negeri Malanf kembali mengukir prestasi gemilang. Kali ini dari Prodi D4	<p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Malang, 28 November 2025 – Jurusan Teknologi Informasi Politeknik Negeri Malanf kembali mengukir prestasi gemilang. Kali ini dari Prodi D4 Sistem Informasi Bisnis (SIB). tim terbaik kami berhasil meraih&nbsp;<span data-start="351" data-end="367" style="font-weight: bolder;">Bronze Medal</span>&nbsp;pada kategori&nbsp;<span data-start="382" data-end="403" style="font-weight: bolder;">subtema Kesehatan&nbsp;</span>dalam ajang Essay Competition Pekan Ilmuwan Muda Nasional&nbsp;<span data-start="382" data-end="403" style="font-weight: bolder;">(PIMNAS 5)&nbsp;</span>yang diselenggarakan oleh&nbsp;<span data-start="382" data-end="403" style="font-weight: bolder;">STIMATA dan Cipta Cita Indonesia.&nbsp;</span>Prestasi ini menjadi bukti bahwa mahasiswa mampu menunjukkan kepedulian terhadap isu kesehatan sekaligus menciptakan gagasan inovatif yang berdampak.&nbsp;</p><p data-start="556" data-end="877" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Tim peraih penghargaan ini terdiri dari tiga mahasiswa inspiratif:&nbsp;<span data-start="623" data-end="658" style="font-weight: bolder;">Dipa Praja Pramono (2341760143)</span>,&nbsp;<span data-start="660" data-end="696" style="font-weight: bolder;">Kartika Tri Juliana (2341760116)</span>, dan&nbsp;<span data-start="702" data-end="738" style="font-weight: bolder;">Nova Diana Ramadhan (2341760104)</span>. Dengan kerja sama, ketekunan, serta penelitian mendalam, mereka mampu menghasilkan essay yang unggul dan diakui oleh dewan juri nasional.</p><p data-start="879" data-end="1118" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Tidak lupa, ucapan terima kasih dan apresiasi kami sampaikan kepada&nbsp;<span data-start="947" data-end="980" style="font-weight: bolder;">Ibu Farida Ulfa, S.Pd., M.Pd.</span>&nbsp;selaku dosen pembimbing. Bimbingan dan dukungan beliau menjadi bagian penting dalam perjalanan tim hingga berhasil meraih pencapaian ini.</p><p data-start="1120" data-end="1388" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Semoga prestasi ini menginspirasi mahasiswa lainnya untuk terus berkarya dan berani berkompetisi di berbagai event ilmiah. Mari terus berkontribusi membawa nama baik kampus serta menghadirkan inovasi yang bermanfaat bagi masyarakat. Selamat dan sukses untuk tim!</p>	2025-12-07 22:23:24.503581	2025-12-07 22:23:24.503581	f	2
6	Jurusan Teknologi Informasi Politeknik Negeri Malang melaksanakan kegiatan dengan tema “AI Ready ASEAN untuk Siswa”	jurusan-teknologi-informasi-politeknik-negeri-malang-melaksanakan-kegiatan-dengan-tema-ai-ready-asean-untuk-siswa	/uploads/blog/69359c83ed733_1765121155.jpg	Malang, 13 November 2025 – Jurusan Teknologi Informasi Politeknik Negeri Malang melaksanakan kegiatan “AI Ready ASEAN untuk Siswa” pada Selasa,	<p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Malang, 13 November 2025 – Jurusan Teknologi Informasi Politeknik Negeri Malang melaksanakan kegiatan “AI Ready ASEAN untuk Siswa” pada Selasa, 11 November 2025, bertempat di Ruang LSI Lantai 6. Kegiatan ini merupakan inisiatif pembelajaran yang bertujuan untuk menyiapkan generasi muda agar lebih memahami dan siap menghadapi perkembangan pesat teknologi Artificial Intelligence (AI) di kawasan ASEAN.</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Acara ini menghadirkan lima narasumber inspiratif, yaitu Dian Anita, Nunuk Alsa, Rini Kartini, Eko Widianto, serta Anak Agung Ayu selaku Korwil Mafindo Malang sekaligus Trainer AI Ready. Para pembicara berbagi wawasan tentang pentingnya literasi digital, etika penggunaan AI, dan peluang karier di bidang teknologi yang semakin berkembang.</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Kegiatan ini diikuti oleh 100 mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang yang antusias mengikuti setiap sesi pelatihan dan diskusi. Melalui kegiatan ini, mahasiswa tidak hanya mendapatkan pengetahuan teoritis, tetapi juga pengalaman praktis dalam memahami konsep AI secara komprehensif.</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Melalui program AI Ready ASEAN untuk Siswa, diharapkan mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang mampu menjadi generasi digital yang inovatif, cerdas, dan berdaya saing tinggi di era transformasi teknologi global.</p>	2025-12-07 22:25:55.973121	2025-12-07 22:25:55.973121	f	2
5	Prestasi kembali diraih oleh mahasiswa Program Studi Sistem Informasi Bisnis dalam ajang Lomba Cipta Nusantara Fest	prestasi-kembali-diraih-oleh-mahasiswa-program-studi-sistem-informasi-bisnis-dalam-ajang-lomba-cipta-nusantara-fest	/uploads/blog/69359c3c370c2_1765121084.jpeg	Malang, 27 November 2025 – Prestasi membanggakan kembali ditorehkan oleh mahasiswa Program Studi Sistem Informasi Bisnis dalam ajang Lomba Cipta	<p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Malang, 27 November 2025 – Prestasi membanggakan kembali ditorehkan oleh mahasiswa Program Studi Sistem Informasi Bisnis dalam ajang&nbsp;<span data-start="178" data-end="208" style="font-weight: bolder;">Lomba Cipta Nusantara Fest</span>&nbsp;yang diselenggarakan di&nbsp;<span data-start="233" data-end="266" style="font-weight: bolder;">Universitas Negeri Yogyakarta.&nbsp;</span>Tim terbaik dari Sistem Informasi Bisnis sukses meraih&nbsp;<span data-start="323" data-end="339" style="font-weight: bolder;">Bronze Medal</span>&nbsp;dalam kategori&nbsp;<span data-start="355" data-end="372" style="font-weight: bolder;">Business Plan</span>. Pencapaian ini menjadi bukti nyata bahwa kreativitas, inovasi, dan kerja keras mampu membawa mahasiswa menuju level kompetisi yang lebih tinggi.</p><p data-start="520" data-end="717" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Tim hebat ini terdiri dari:<br data-start="547" data-end="550"><img decoding="async" class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/16.0.1/svg/31-20e3.svg" alt="1️⃣" style="max-width: 100%; height: auto; transition: 0.3s ease-out; border: none; box-shadow: none; border-radius: 0px; vertical-align: -0.1em !important; display: inline !important; width: 1em !important; margin: 0px 0.07em !important; background: none !important; padding: 0px !important;">&nbsp;<span data-start="554" data-end="598" style="font-weight: bolder;">Dimas Rosyidin (Sistem Informasi Bisnis)</span><br data-start="598" data-end="601"><img decoding="async" class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/16.0.1/svg/32-20e3.svg" alt="2️⃣" style="max-width: 100%; height: auto; transition: 0.3s ease-out; border: none; box-shadow: none; border-radius: 0px; vertical-align: -0.1em !important; display: inline !important; width: 1em !important; margin: 0px 0.07em !important; background: none !important; padding: 0px !important;">&nbsp;<span data-start="605" data-end="656" style="font-weight: bolder;">Andreas Gale Dwi Jaya (Sistem Informasi Bisnis)</span><br data-start="656" data-end="659"><img decoding="async" class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/16.0.1/svg/33-20e3.svg" alt="3️⃣" style="max-width: 100%; height: auto; transition: 0.3s ease-out; border: none; box-shadow: none; border-radius: 0px; vertical-align: -0.1em !important; display: inline !important; width: 1em !important; margin: 0px 0.07em !important; background: none !important; padding: 0px !important;">&nbsp;<span data-start="663" data-end="715" data-is-only-node="" style="font-weight: bolder;">Agta Fadjrin Aminullah (Sistem Informasi Bisnis)</span></p><p data-start="520" data-end="717" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Dosen Pembimbing : Vivi Nur Wijayaningrum, S.Kom, M.Kom</p><p data-start="719" data-end="1146" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Melalui ide bisnis yang visioner, terstruktur, dan relevan dengan kebutuhan industri masa kini, mereka berhasil membuktikan bahwa mahasiswa Sistem Informasi Bisnis mampu bersaing dan berprestasi. Tidak hanya mengasah kemampuan berpikir kritis, kompetisi ini juga menguji kemampuan kolaborasi, analisis pasar, serta keberanian mereka dalam mempresentasikan gagasan secara profesional.</p><p data-start="1148" data-end="1449" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Keberhasilan ini diharapkan menjadi inspirasi bagi mahasiswa lainnya untuk terus berkarya, berinovasi, dan berani mengikuti kompetisi serupa. Semoga prestasi ini membuka peluang lebih besar bagi tim maupun jurusan untuk semakin dikenal sebagai pusat talenta unggul di bidang bisnis berbasis teknologi.</p><p data-start="1451" data-end="1576" data-is-last-node="" data-is-only-node="" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Selamat kepada seluruh anggota tim! Terus maju dan berkarya untuk membawa nama baik kampus ke tingkat yang lebih tinggi!</p>	2025-12-07 22:24:44.226496	2025-12-07 22:24:44.226496	f	2
3	Mahasiswa D4 Sistem Informasi Bisnis Jurusan Teknologi Informasi meraih Juara 1 ajang RK INK BLEND COMPETITION!	mahasiswa-d4-sistem-informasi-bisnis-jurusan-teknologi-informasi-meraih-juara-1-ajang-rk-ink-blend-competition	/uploads/blog/69359b5fe4896_1765120863.jpeg	Mahasiswa SIB, Farel Maryam Laila Hajiri, meraih Juara 1 Lomba Esai pada RK INK BLEND Competition. Prestasi ini menunjukkan kemampuan literasi ilmiah mahasiswa SIB yang mampu bersaing di tingkat nasio	<p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Malang, 28 November 2025 – Pada ajang&nbsp;<span data-start="196" data-end="224" style="font-weight: bolder;">RK INK BLEND COMPETITION</span>&nbsp;yang diselenggarakan oleh&nbsp;<span data-start="251" data-end="286" style="font-weight: bolder;">RumahKIPK Universitas Siliwangi</span>, mahasiswa inspiratif kami,&nbsp;<span data-start="315" data-end="364" style="font-weight: bolder;">Farel Maryam Laila Hajiri (D4-SIB/2341760028)</span>, sukses menorehkan hasil terbaik dengan meraih&nbsp;<span data-start="412" data-end="434" style="font-weight: bolder;">Juara 1 Lomba Esai</span>. Kemenangan ini menjadi bukti nyata bahwa kemampuan literasi ilmiah mahasiswa SIB mampu bersaing dan unggul di tingkat nasional.<span data-start="244" data-end="279" style="font-weight: bolder;"><br></span></p><p data-start="565" data-end="951" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Dalam kompetisi ini, Farel menampilkan esai dengan ide yang kuat, penyusunan argumen yang logis, serta analisis yang matang sehingga mendapatkan apresiasi tinggi dari dewan juri. Prestasi tersebut menunjukkan bahwa kemampuan mahasiswa tidak hanya terbatas pada dunia teknologi dan bisnis, tetapi juga mencakup kemampuan menulis, berpikir kritis, dan menyampaikan gagasan secara efektif.</p><p data-start="953" data-end="1324" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Keberhasilan ini tentunya tidak terlepas dari dukungan dan bimbingan penuh dari&nbsp;<span data-start="1033" data-end="1066" style="font-weight: bolder;">Ibu Farida Ulfa, S.Pd., M.Pd.</span>, selaku dosen pembimbing. Dengan arahan beliau, Farel mampu memperdalam isi esai, memperbaiki struktur tulisan, serta memastikan setiap gagasan tersampaikan dengan jelas dan berbobot. Dedikasi beliau memberikan kontribusi besar dalam keberhasilan karya ini.</p><p data-start="1326" data-end="1650" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Semoga kemenangan ini dapat menjadi inspirasi bagi seluruh mahasiswa untuk terus mengasah kemampuan, mengikuti berbagai kompetisi, dan menciptakan karya yang berdampak.&nbsp;</p><p data-start="1326" data-end="1650" style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Selamat kepada Farel atas pencapaian luar biasa ini! Teruslah berkarya dan jadilah representasi terbaik bagi kampus dalam berbagai ajang prestasi.</p>	2025-12-07 22:21:03.93774	2025-12-08 08:03:54.839038	f	2
7	Jurusan Teknologi Informasi Politeknik Negeri Malang menerima kunjungan dari SMA Negeri 3 Kota Malang	jurusan-teknologi-informasi-politeknik-negeri-malang-menerima-kunjungan-dari-sma-negeri-3-kota-malang	/uploads/blog/69359d7599514_1765121397.jpg	Malang, 12 November 2025 – Jurusan Teknologi Informasi Politeknik Negeri Malang menerima kunjungan dari SMA Negeri 3 Kota Malang dalam	<p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Malang, 12 November 2025 –&nbsp;<span style="font-weight: bolder;"><span style="font-weight: normal;">Jurusan Teknologi Informasi Politeknik Negeri Malang&nbsp;</span></span>menerima kunjungan dari&nbsp;<span data-start="104" data-end="132" style="font-weight: bolder;"><span style="font-weight: normal;">SMA Negeri 3 Kota Malang</span></span>&nbsp;dalam kegiatan&nbsp;<em data-start="148" data-end="162">Mini Outdoor Learning to Politeknik Negeri Malang</em>&nbsp;yang berlangsung penuh semangat dan antusiasme. Kegiatan ini bertujuan untuk memperkenalkan lingkungan kampus Politeknik Negeri Malang, khususnya&nbsp;<span data-start="299" data-end="330" style="font-weight: bolder;"><span style="font-weight: normal;">Jurusan Teknologi Informasi</span></span>&nbsp;kepada para siswa. Agar mereka lebih mengenal dunia perkuliahan di bidang teknologi dan termotivasi untuk melanjutkan studi di jurusan ini.</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Acara diawali dengan sambutan sekaligus penyampaian materi oleh&nbsp;<span data-start="541" data-end="624" style="font-weight: bolder;"><span style="font-weight: normal;">Kepala Jurusan Teknologi Informasi, Prof. Dr. Eng. Rosa Andrie Asmara, ST., MT.</span></span>, yang memberikan wawasan mengenai profil dan keunggulan jurusan.&nbsp;</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;">Dilanjutkan oleh&nbsp;<span data-start="714" data-end="759" style="font-weight: bolder;"><span style="font-weight: normal;">Bapak Dika Rizky Yunianto, S.Kom., M.Kom.</span></span>, yang menjelaskan tentang&nbsp;<span data-start="800" data-end="838" style="font-weight: bolder;"><span style="font-weight: normal;">peluang kerja serta prospek karier</span></span>&nbsp;bagi lulusan Teknologi Informasi di era industri digital.&nbsp;Selanjutnya,&nbsp;<span data-start="944" data-end="982" style="font-weight: bolder;"><span style="font-weight: normal;">Bapak Dimas Wahyu Wibowo, ST., MT.</span></span>&nbsp;memperkenalkan&nbsp;<span data-start="998" data-end="1054" style="font-weight: bolder;"><span style="font-weight: normal;">Laboratorium Multimedia dan Rekayasa Perangkat Lunak</span></span>, serta menampilkan berbagai&nbsp;<span data-start="1083" data-end="1113" style="font-weight: bolder;"><span style="font-weight: normal;">produk multimedia inovatif</span></span>&nbsp;karya mahasiswa.</p><p style="margin-bottom: 20px; color: rgb(84, 84, 84); line-height: 1.5; font-family: Rubik, sans-serif; text-align: justify;"><b>Sebagai penutup, para siswa diajak berkeliling untuk melihat langsung fasilitas, ruang laboratorium, dan suasana belajar di Jurusan Teknologi Informasi. Melalui kegiatan ini, diharapkan semakin banyak siswa yang tertarik dan termotivasi untuk bergabung dengan&nbsp;<span data-start="1394" data-end="1434" style="">Jurusan Teknologi Informasi Politeknik Negeri Malang.</span></b></p>	2025-12-07 22:29:57.628434	2025-12-15 20:32:41.511419	t	2
\.


--
-- TOC entry 3847 (class 0 OID 25960)
-- Dependencies: 233
-- Data for Name: fokusriset; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fokusriset (id, title, icon, description, created_at, updated_at) FROM stdin;
1	Software Engineering Methodologies and Architecture	bi-diagram-3-fill	Riset tentang metodologi dan arsitektur perangkat lunak untuk meningkatkan kualitas, maintainability, dan efisiensi pengembangan sistem.	2025-12-03 11:35:38.964352	2025-12-03 11:35:38.964352
2	Domain-Specific Software Engineering Applications	bi-arrow-right-circle-fill	Fokus riset pada penerapan rekayasa perangkat lunak di berbagai domain spesifik, meliputi teknologi pendidikan, startup dan kewirausahaan, FinTech, otomasi industri/smart manufacturing, serta layanan kesehatan digital.	2025-12-03 11:37:33.692394	2025-12-03 11:37:33.692394
3	Emerging Technologies in Software Engineering	bi-code-square	Fokus riset pada teknologi emerging untuk otomasi dan peningkatan kualitas rekayasa perangkat lunak, seperti analisis kualitas kode, prediksi bug, generasi test case, otomasi requirements, refactoring berbasis AI, form generator, dan tools dokumentasi.	2025-12-07 20:32:20.510379	2025-12-07 20:32:20.510379
\.


--
-- TOC entry 3845 (class 0 OID 25945)
-- Dependencies: 231
-- Data for Name: password_reset_requests; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_requests (id, user_id, status, created_at, updated_at) FROM stdin;
1	1	rejected	2025-12-03 05:56:38.918421	2025-12-03 06:19:19.69521
2	2	rejected	2025-12-08 09:52:48.054655	2025-12-08 10:02:10.087614
3	4	pending	2025-12-15 20:32:49.447439	2025-12-15 20:32:49.447439
\.


--
-- TOC entry 3851 (class 0 OID 25983)
-- Dependencies: 237
-- Data for Name: pendaftar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pendaftar (id, nama, email, no_hp, nim, angkatan, program_studi, portofolio_url, alasan, status, created_at, updated_at, peminatan, keahlian, catatan) FROM stdin;
12	Wandi	wandider@gmail.com	085250314485	244107020003	2024	D4 Teknik Informatika	http://localhost:8888/web_profil_lab_se/admin/rekrutmen	test	Diterima	2025-12-11 12:54:55.795534	2025-12-11 13:04:01.429711	Web Development	Laravel, React	
15	Nadya	nadyaaurora575@gmail.com	085174187786	244107020034	2024	D4 Teknik Informatika	https://porto	biar keren	Diterima	2025-12-15 20:35:08.653667	2025-12-15 20:35:36.733953	Web	Laravel	
13	Sultan	sultanariva55@gmail.com	asd	asd	2024	D4 Teknik Informatika	https://www.linkedin.com/in/sultan-nashira-ariva-5758ba326/	gabut	Diterima	2025-12-15 08:36:41.455314	2025-12-16 14:32:41.196338	Web Developer	Laravel	
\.


--
-- TOC entry 3837 (class 0 OID 25850)
-- Dependencies: 223
-- Data for Name: personil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personil (id, nama, kategori, "position", email, nidn, keahlian, pendidikan, linkedin, github, foto_url, created_at, updated_at, urutan, link_sinta, link_scholar) FROM stdin;
11	Ariadi Retno Ririd, S.Kom., M.Kom.	Dosen	Peneliti	faniri4education@gmail.com	0010088101	Data Mining	["S2 \\u2014 Magister Komputer, Institut Teknologi Sepuluh Nopember (2010)","S1 \\u2014 Sarjana Komputer, Institut Teknologi Sepuluh Nopember (2004)"]			/uploads/dosen/dosen_1765113198_69357d6ecbed4.jpg	2025-12-07 20:13:18.839931	2025-12-07 20:13:18.839931	5	https://sinta.kemdiktisaintek.go.id/authors/profile/6018827/	https://scholar.google.com/citations?view_op=list_works&hl=id&hl=id&user=qoWiXaQAAAAJ
12	Elok Nur Hamdana, S.T., M.T	Dosen	Peneliti	elokhamdana@gmail.com	0702108601	Sistem Informasi	["S2 \\u2014 Magister Teknik, Universitas Brawijaya (2012)"]	https://www.linkedin.com/in/elok-hamdana-4a07671b6/		/uploads/dosen/dosen_1765113324_69357dec3b4b6.jpg	2025-12-07 20:15:24.244372	2025-12-07 20:15:24.244372	6	https://sinta.kemdiktisaintek.go.id/authors/profile/6754038	https://scholar.google.com/citations?user=cduv_fAAAAAJ&hl=en
1	Imam Fahrur Rozi, ST., MT.	Dosen	Kepala Laboratorium	imam.rozi@gmail.com	0010068402	Programming, Software, Data Mining, Text Processing	["S2 \\u2014 Teknik Elektro, Universitas Brawijaya (2010-2012)","S1 \\u2014 Teknik Elektro, Universitas Brawijaya (2002-2007)"]	https://www.linkedin.com/in/imam-fahrur-rozi-93a29745/		/uploads/dosen/dosen_1765113336_69357df887c85.jpg	2025-12-01 07:44:21.873066	2025-12-07 20:15:36.557634	1	https://sinta.kemdiktisaintek.go.id/authors/profile/6005739	https://scholar.google.com/citations?user=WwrDWnEAAAAJ&hl=en
2	Ridwan Rismanto, SST., M.Kom.	Dosen	Peneliti	rismanto@polinema.ac.id	0018038602	Computer Science	["S3 \\u2013 Teknologi Informasi, Hiroshima University (2020-2025)","S2 \\u2013 Computer Science, Kumamoto University (2011)","S1 \\u2013 Teknik Informatika, Institut Teknologi Sepuluh Nopember (2009-2011)"]	https://www.linkedin.com/in/ridwan-rismanto/		/uploads/dosen/dosen_1765113347_69357e032bc15.jpg	2025-12-01 07:44:21.873066	2025-12-07 20:15:47.180689	2	https://sinta.kemdiktisaintek.go.id/authors/profile/6018829	https://scholar.google.com/citations?hl=en&user=fJc_GegAAAAJ
3	Moch. Zawaruddin Abdullah, S.ST., M.Kom	Dosen	Peneliti	zawaruddin@polinema.ac.id	0010028906	Information Retrieval, Data Mining, Information System, Data Science, AI	["S2 \\u2014 Teknik Informatika, Institut Teknologi Sepuluh Nopember (2016-2018)","D4 \\u2014 Teknik Informatika, Politeknik Elektronika Negeri Surabaya (2011-2013)","D3 \\u2014 Teknik Informatika, Politeknik Negeri Bandung (2007-2010)"]	https://www.linkedin.com/in/zawaruddin/		/uploads/dosen/dosen_1765113357_69357e0d297f1.jpg	2025-12-01 07:44:21.873066	2025-12-07 20:15:57.17131	4	https://sinta.kemdiktisaintek.go.id/authors/profile/6714037	https://scholar.google.com/citations?user=0uPC_KcAAAAJ&hl=id
15	Wandi	Mahasiswa	Anggota	wandider@gmail.com	244107020003	Laravel, React	D4 Teknik Informatika	\N	\N	\N	2025-12-11 13:04:01.429711	2025-12-11 13:04:01.429711	999	\N	\N
17	Nadya	Mahasiswa	Anggota	nadyaaurora575@gmail.com	244107020034	Laravel	D4 Teknik Informatika	\N	\N	\N	2025-12-15 20:35:36.733953	2025-12-15 20:35:36.733953	999	\N	\N
9	Dian Hanifudin Subhi, S.Kom., M.Kom.	Dosen	Peneliti	subhi11@mhs.if.its.ac.id	0010068807	Cloud Computing	["S2 \\u2014 Teknik Informatika, Institut Teknologi Sepuluh Nopember (2011-2015)","S1 \\u2014 Teknik Informatika, Institut Teknologi Sepuluh Nopember (2006-2010)"]	https://www.linkedin.com/in/dhanifudin/		/uploads/dosen/dosen_1765112800_69357be089b58.jpg	2025-12-06 05:47:42.885949	2025-12-07 20:06:40.565331	3	https://sinta.kemdiktisaintek.go.id/authors/profile/6736320	https://scholar.google.com/citations?user=pR2Dn7MAAAAJ&hl=en
18	Sultan	Mahasiswa	Anggota	sultanariva55@gmail.com	asd	Laravel	D4 Teknik Informatika	\N	\N	\N	2025-12-16 14:32:34.982793	2025-12-16 14:32:34.982793	999	\N	\N
\.


--
-- TOC entry 3843 (class 0 OID 25928)
-- Dependencies: 229
-- Data for Name: publikasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.publikasi (id, personil_id, judul, tahun, url, created_at, updated_at) FROM stdin;
3	1	Implementasi opinion mining (analisis sentimen) untuk ekstraksi data opini publik pada perguruan tinggi	2012	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:M3NEmzRMIkIC	2025-12-07 21:44:42.697952	2025-12-07 21:44:52.774619
4	1	Pengembangan sistem penunjang keputusan penentuan ukt mahasiswa dengan menggunakan metode moora studi kasus politeknik negeri malang	2017	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:RHpTSmoSYBkC	2025-12-07 21:45:56.454143	2025-12-07 21:45:56.454143
5	1	Comparison of feature extraction in support vector machine (SVM) based sentiment analysis system	2025	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:tkaPQYYpVKoC	2025-12-07 21:48:03.474048	2025-12-07 21:48:03.474048
6	1	Analisis Performa Metode Extreme Learning Machine dan Multiple Linear Regression dalam Prediksi Produksi Gula	2025	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:Mojj43d5GZwC	2025-12-07 21:48:34.752029	2025-12-07 21:48:34.752029
8	1	PENDAMPINGAN PEMBUATAN ALAT PERAGA EDUKATIF UNTUK GURU POS PAUD ASPARAGA	2023	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:D_sINldO8mEC	2025-12-07 21:49:47.035325	2025-12-07 21:49:47.035325
9	1	 Live K-Means Clustering Pada Wireless Sensor Network Menggunakan Google Maps API	2021	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:738O_yMBCRsC	2025-12-07 21:50:53.202394	2025-12-07 21:50:53.202394
7	1	Analyzing the Application of Optical Character Recognition: A Case Study in International Standard Book Number Detection	2025	https://scholar.google.com/citations?view_op=view_citation&hl=en&user=WwrDWnEAAAAJ&pagesize=100&sortby=pubdate&citation_for_view=WwrDWnEAAAAJ:WA5NYHcadZ8C	2025-12-07 21:49:07.630741	2025-12-08 09:50:48.414283
\.


--
-- TOC entry 3829 (class 0 OID 25628)
-- Dependencies: 215
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (id, name) FROM stdin;
1	super-admin
2	admin
\.


--
-- TOC entry 3849 (class 0 OID 25972)
-- Dependencies: 235
-- Data for Name: scope_penelitian; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.scope_penelitian (id, kategori, deskripsi, icon_url, icon_bootstrap, tags, created_at, updated_at) FROM stdin;
1	Analisis & Perancangan Sistem Informasi	Proses sistematis yang membahas pemahaman kebutuhan bisnis dan perancangan solusi informasi. Mencakup siklus hidup pengembangan sistem, mulai dari analisis kebutuhan hingga perancangan arsitektur sistem.	/uploads/scope/6934b16711bdf_1765060967.png	bi-search	["Analisis Kebutuhan","Perancangan Sistem","SDLC","PWA"]	2025-12-03 12:17:41.592821	2025-12-16 14:39:59.676153
4	Pemrograman Backend	Fokus pada pengembangan logika server, pengelolaan database, dan API yang berada di balik layar sebuah aplikasi web, memastikan data diproses dan disimpan dengan efisien.	\N	bi-database-fill	["Backend","Basis Data","API"]	2025-12-07 21:19:40.99237	2025-12-07 21:19:40.99237
6	Pemrograman Web	Mata kuliah ini mengajarkan dasar-dasar pembuatan halaman web statis, termasuk penggunaan HTML untuk struktur dan CSS untuk gaya visual.	\N	bi-code	["HTML","CSS","Dasar Web"]	2025-12-07 21:23:53.122979	2025-12-07 21:28:31.849346
2	Analisis dan Desain Berorientasi Objek (ADBO)	Metodologi pengembangan perangkat lunak yang menggunakan objek sebagai dasar untuk menganalisis kebutuhan sistem dan merancang arsitektur aplikasi yang kompleks.	\N	bi-arrow-repeat	["Analisis Berorientasi Objek","UML"]	2025-12-03 12:18:36.889969	2025-12-07 21:34:34.072759
3	Desain & Pemrograman Web	Pembahasan mengenai prinsip-prinsip perancangan antarmuka visual (frontend) dan fungsionalitas dasar (backend) untuk membuat situs web yang menarik dan mudah digunakan.		bi-code-slash	["Pengembangan Web","Frontend","Backend"]	2025-12-07 05:47:27.366237	2025-12-07 21:35:58.657332
5	Pemrograman Berbasis Framework	Mata kuliah ini membahas penggunaan kerangka kerja (framework) untuk mempercepat dan menata proses pengembangan perangkat lunak dengan memanfaatkan struktur dan pustaka yang sudah tersedia.	\N	bi-diagram-3-fill	["Framework","Pengembangan Aplikasi","Arsitektur Perangkat Lunak"]	2025-12-07 21:21:06.955232	2025-12-07 21:37:00.481381
7	Pemrograman Web Lanjut	Lanjutan dari Pemrograman Web, dengan fokus pada pembuatan halaman web dinamis dan interaktif menggunakan JavaScript dan teknologi web modern lainnya.	\N	bi-card-list	["JavaScript","Web Dinamis","Teknologi Web Modern"]	2025-12-07 21:24:33.8717	2025-12-07 21:38:25.428791
8	Penjaminan Mutu Perangkat Lunak	Mata kuliah ini membahas proses dan teknik untuk memastikan kualitas perangkat lunak. Fokusnya adalah pada pengujian, verifikasi, dan validasi untuk menemukan dan memperbaiki cacat sebelum produk dirilis.	\N	bi-bug-fill	["Pengujian Perangkat Lunak","Quality Assurance","Validasi dan Verifikasi"]	2025-12-07 21:25:18.747845	2025-12-07 21:39:33.026495
9	Rekayasa Perangkat Lunak	Pendekatan sistematis dan terstruktur dalam pengembangan perangkat lunak. Mencakup seluruh siklus hidup pengembangan, dari perencanaan, desain, implementasi, hingga pemeliharaan.	\N	bi-pc-display-horizontal	["Manajemen Proyek Perangkat Lunak","Metodologi Pengembangan"]	2025-12-07 21:25:57.142594	2025-12-07 21:40:59.52642
\.


--
-- TOC entry 3835 (class 0 OID 25823)
-- Dependencies: 221
-- Data for Name: tentang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tentang (id, judul, konten, gambar, created_at, updated_at) FROM stdin;
1	Tentang Laboratorium Software Engineering	<b>Laboratorium Software Engineering merupakan salah satu laboratorium unggulan di Jurusan Teknologi Informasi, Politeknik Negeri Malang.</b>	/assets/images/tentang/tentang_1765156532_693626b4bcf1e.jpg	2025-12-01 06:28:00.814997	2025-12-08 08:15:32.776223
\.


--
-- TOC entry 3831 (class 0 OID 25635)
-- Dependencies: 217
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password_hash, role_id, nama_lengkap) FROM stdin;
1	super-admin	$2y$10$CzOmCmvYmX2c/mXtbVihWOOwnD5gnTnzoCDjKiC1BL669e0Z/nR9i	1	\N
2	admin	$2y$10$e3lwUFQGzgtzKf3XjdFpPe0P5B3AdCxAg6dK.p/mxQuayQsEX.vCS	2	\N
3	wandi	$2y$12$ZvRMPY47qUocAcIHyIMxQubimBtctD8YzLAy0rMtOE38jqjyMHbOO	1	\N
4	sultan	$2y$12$C9V5LWzyCEzxq2TGXswQCuabj.8oLyWcXx6xIIBIlU985m2ssr9Je	2	\N
\.


--
-- TOC entry 3833 (class 0 OID 25798)
-- Dependencies: 219
-- Data for Name: visi_misi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.visi_misi (id, kategori, konten, created_at) FROM stdin;
1	visi	Menjadi pusat unggulan dalam pengembangan ilmu pengetahuan, teknologi, dan inovasi di bidang Rekayasa Perangkat Lunak yang berdaya saing global, dengan kontribusi nyata pada kemajuan akademik, industri, dan masyarakat.	2025-11-27 12:05:57.708819
2	misi	Mengembangkan Kompetensi Mahasiswa	2025-11-27 12:06:00.114623
3	misi	Mendorong Penelitian Fundamental dan Terapan	2025-11-27 12:06:00.114623
4	misi	Mengintegrasikan Kolaborasi Multi-Disiplin	2025-11-27 12:06:00.114623
5	misi	Mengoptimalkan Pemanfaatan Teknologi Terkini	2025-11-27 12:06:00.114623
7	misi	Mewujudkan Pengabdian Masyarakat Berbasis Riset	2025-12-07 19:27:45.690398
\.


--
-- TOC entry 3870 (class 0 OID 0)
-- Dependencies: 224
-- Name: album_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.album_id_seq', 4, true);


--
-- TOC entry 3871 (class 0 OID 0)
-- Dependencies: 226
-- Name: article_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.article_id_seq', 7, true);


--
-- TOC entry 3872 (class 0 OID 0)
-- Dependencies: 232
-- Name: fokusriset_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fokusriset_id_seq', 3, true);


--
-- TOC entry 3873 (class 0 OID 0)
-- Dependencies: 230
-- Name: password_reset_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.password_reset_requests_id_seq', 3, true);


--
-- TOC entry 3874 (class 0 OID 0)
-- Dependencies: 236
-- Name: pendaftar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pendaftar_id_seq', 15, true);


--
-- TOC entry 3875 (class 0 OID 0)
-- Dependencies: 222
-- Name: personil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personil_id_seq', 18, true);


--
-- TOC entry 3876 (class 0 OID 0)
-- Dependencies: 228
-- Name: publikasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.publikasi_id_seq', 9, true);


--
-- TOC entry 3877 (class 0 OID 0)
-- Dependencies: 214
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_id_seq', 2, true);


--
-- TOC entry 3878 (class 0 OID 0)
-- Dependencies: 234
-- Name: scope_penelitian_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.scope_penelitian_id_seq', 11, true);


--
-- TOC entry 3879 (class 0 OID 0)
-- Dependencies: 220
-- Name: tentang_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tentang_id_seq', 1, true);


--
-- TOC entry 3880 (class 0 OID 0)
-- Dependencies: 216
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 5, true);


--
-- TOC entry 3881 (class 0 OID 0)
-- Dependencies: 218
-- Name: visi_misi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visi_misi_id_seq', 11, true);


--
-- TOC entry 3662 (class 2606 OID 25873)
-- Name: album album_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album
    ADD CONSTRAINT album_pkey PRIMARY KEY (id);


--
-- TOC entry 3664 (class 2606 OID 25908)
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- TOC entry 3666 (class 2606 OID 25910)
-- Name: article article_slug_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_slug_key UNIQUE (slug);


--
-- TOC entry 3674 (class 2606 OID 25970)
-- Name: fokusriset fokusriset_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fokusriset
    ADD CONSTRAINT fokusriset_pkey PRIMARY KEY (id);


--
-- TOC entry 3672 (class 2606 OID 25953)
-- Name: password_reset_requests password_reset_requests_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_requests
    ADD CONSTRAINT password_reset_requests_pkey PRIMARY KEY (id);


--
-- TOC entry 3678 (class 2606 OID 25997)
-- Name: pendaftar pendaftar_nim_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendaftar
    ADD CONSTRAINT pendaftar_nim_unique UNIQUE (nim);


--
-- TOC entry 3680 (class 2606 OID 25994)
-- Name: pendaftar pendaftar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendaftar
    ADD CONSTRAINT pendaftar_pkey PRIMARY KEY (id);


--
-- TOC entry 3660 (class 2606 OID 25860)
-- Name: personil personil_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil
    ADD CONSTRAINT personil_pkey PRIMARY KEY (id);


--
-- TOC entry 3670 (class 2606 OID 25937)
-- Name: publikasi publikasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi
    ADD CONSTRAINT publikasi_pkey PRIMARY KEY (id);


--
-- TOC entry 3651 (class 2606 OID 25633)
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- TOC entry 3676 (class 2606 OID 25981)
-- Name: scope_penelitian scope_penelitian_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scope_penelitian
    ADD CONSTRAINT scope_penelitian_pkey PRIMARY KEY (id);


--
-- TOC entry 3658 (class 2606 OID 25832)
-- Name: tentang tentang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tentang
    ADD CONSTRAINT tentang_pkey PRIMARY KEY (id);


--
-- TOC entry 3653 (class 2606 OID 25640)
-- Name: users user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 3656 (class 2606 OID 25807)
-- Name: visi_misi visi_misi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi
    ADD CONSTRAINT visi_misi_pkey PRIMARY KEY (id);


--
-- TOC entry 3667 (class 1259 OID 25912)
-- Name: idx_article_created_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_article_created_at ON public.article USING btree (created_at DESC);


--
-- TOC entry 3668 (class 1259 OID 25911)
-- Name: idx_article_slug; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_article_slug ON public.article USING btree (slug);


--
-- TOC entry 3654 (class 1259 OID 25808)
-- Name: idx_kategori; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_kategori ON public.visi_misi USING btree (kategori);


--
-- TOC entry 3684 (class 2620 OID 25861)
-- Name: personil update_personil_timestamp; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER update_personil_timestamp BEFORE UPDATE ON public.personil FOR EACH ROW EXECUTE FUNCTION public.update_personil_updated_at();


--
-- TOC entry 3682 (class 2606 OID 25938)
-- Name: publikasi fk_publikasi_personil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi
    ADD CONSTRAINT fk_publikasi_personil FOREIGN KEY (personil_id) REFERENCES public.personil(id) ON DELETE CASCADE;


--
-- TOC entry 3683 (class 2606 OID 25954)
-- Name: password_reset_requests fk_reset_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_requests
    ADD CONSTRAINT fk_reset_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3681 (class 2606 OID 25641)
-- Name: users user_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.role(id);


--
-- TOC entry 3852 (class 0 OID 25998)
-- Dependencies: 238 3854
-- Name: mv_admin_stats; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: postgres
--

REFRESH MATERIALIZED VIEW public.mv_admin_stats;


-- Completed on 2025-12-19 09:04:31 WIB

--
-- PostgreSQL database dump complete
--

\unrestrict iYYx6jpcxIbYHrgFzMEBtNSTW2DLN6ly6urMNbUmUVkeeROrtHwapYhTRDUtU9P

