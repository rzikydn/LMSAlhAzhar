--
-- PostgreSQL database dump
--

\restrict Jo7LxIYuxxajJ5dIhokSjHRfuxCUPtCjfP8f4vsEBkGxHb46CJ0dsraSR4jRcaB

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: badges; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.badges (
    id bigint NOT NULL,
    nama character varying(100) NOT NULL,
    deskripsi character varying(255) NOT NULL,
    icon character varying(10) DEFAULT '⭐'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.badges OWNER TO postgres;

--
-- Name: badges_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.badges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.badges_id_seq OWNER TO postgres;

--
-- Name: badges_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.badges_id_seq OWNED BY public.badges.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration bigint NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration bigint NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: catatan_wali; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catatan_wali (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    semester character varying(50) DEFAULT 'Genap 2025/2026'::character varying NOT NULL,
    catatan text NOT NULL,
    created_by bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.catatan_wali OWNER TO postgres;

--
-- Name: catatan_wali_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.catatan_wali_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.catatan_wali_id_seq OWNER TO postgres;

--
-- Name: catatan_wali_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.catatan_wali_id_seq OWNED BY public.catatan_wali.id;


--
-- Name: cbt_exams; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cbt_exams (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    mapel_id bigint NOT NULL,
    kelas_id bigint,
    guru_id bigint NOT NULL,
    durasi integer NOT NULL,
    jumlah_soal integer DEFAULT 0 NOT NULL,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    approved_by bigint,
    approved_at timestamp(0) without time zone,
    catatan_reject text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    tipe character varying(255) DEFAULT 'ulangan'::character varying NOT NULL,
    CONSTRAINT cbt_exams_status_check CHECK (((status)::text = ANY ((ARRAY['draft'::character varying, 'pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[]))),
    CONSTRAINT cbt_exams_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['ulangan'::character varying, 'uts'::character varying, 'uas'::character varying])::text[])))
);


ALTER TABLE public.cbt_exams OWNER TO postgres;

--
-- Name: COLUMN cbt_exams.durasi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.cbt_exams.durasi IS 'menit';


--
-- Name: cbt_exams_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cbt_exams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cbt_exams_id_seq OWNER TO postgres;

--
-- Name: cbt_exams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cbt_exams_id_seq OWNED BY public.cbt_exams.id;


--
-- Name: cbt_jawabans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cbt_jawabans (
    id bigint NOT NULL,
    cbt_exam_id bigint NOT NULL,
    cbt_soal_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    jawaban text,
    nilai numeric(5,2),
    dinilai boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cbt_jawabans OWNER TO postgres;

--
-- Name: cbt_jawabans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cbt_jawabans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cbt_jawabans_id_seq OWNER TO postgres;

--
-- Name: cbt_jawabans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cbt_jawabans_id_seq OWNED BY public.cbt_jawabans.id;


--
-- Name: cbt_soals; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cbt_soals (
    id bigint NOT NULL,
    cbt_exam_id bigint NOT NULL,
    nomor integer NOT NULL,
    soal text NOT NULL,
    tipe character varying(255) DEFAULT 'pg'::character varying NOT NULL,
    pilihan_a text,
    pilihan_b text,
    pilihan_c text,
    pilihan_d text,
    jawaban_benar character varying(10),
    bobot integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT cbt_soals_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['pg'::character varying, 'essay'::character varying])::text[])))
);


ALTER TABLE public.cbt_soals OWNER TO postgres;

--
-- Name: cbt_soals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cbt_soals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cbt_soals_id_seq OWNER TO postgres;

--
-- Name: cbt_soals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cbt_soals_id_seq OWNED BY public.cbt_soals.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection character varying(255) NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: guru; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.guru (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    nip character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    mapel_id bigint,
    alamat text,
    no_telp character varying(255),
    status character varying(255) DEFAULT 'aktif'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT guru_status_check CHECK (((status)::text = ANY ((ARRAY['aktif'::character varying, 'nonaktif'::character varying])::text[])))
);


ALTER TABLE public.guru OWNER TO postgres;

--
-- Name: guru_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.guru_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.guru_id_seq OWNER TO postgres;

--
-- Name: guru_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.guru_id_seq OWNED BY public.guru.id;


--
-- Name: jadwal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jadwal (
    id bigint NOT NULL,
    kelas_id bigint NOT NULL,
    mapel_id bigint NOT NULL,
    guru_id bigint NOT NULL,
    hari character varying(255) NOT NULL,
    jam_mulai time(0) without time zone NOT NULL,
    jam_selesai time(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jadwal OWNER TO postgres;

--
-- Name: jadwal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jadwal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jadwal_id_seq OWNER TO postgres;

--
-- Name: jadwal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jadwal_id_seq OWNED BY public.jadwal.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: kehadiran; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kehadiran (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    tanggal date NOT NULL,
    status character varying(255) NOT NULL,
    keterangan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT kehadiran_status_check CHECK (((status)::text = ANY ((ARRAY['hadir'::character varying, 'sakit'::character varying, 'izin'::character varying, 'alpha'::character varying])::text[])))
);


ALTER TABLE public.kehadiran OWNER TO postgres;

--
-- Name: kehadiran_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kehadiran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kehadiran_id_seq OWNER TO postgres;

--
-- Name: kehadiran_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kehadiran_id_seq OWNED BY public.kehadiran.id;


--
-- Name: kelas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kelas (
    id bigint NOT NULL,
    nama_kelas character varying(255) NOT NULL,
    jenjang character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT kelas_jenjang_check CHECK (((jenjang)::text = ANY ((ARRAY['SD'::character varying, 'SMP'::character varying])::text[])))
);


ALTER TABLE public.kelas OWNER TO postgres;

--
-- Name: kelas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kelas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kelas_id_seq OWNER TO postgres;

--
-- Name: kelas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kelas_id_seq OWNED BY public.kelas.id;


--
-- Name: log_aktivitas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.log_aktivitas (
    id bigint NOT NULL,
    user_id bigint,
    tipe character varying(50) NOT NULL,
    deskripsi text NOT NULL,
    status character varying(50),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.log_aktivitas OWNER TO postgres;

--
-- Name: log_aktivitas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.log_aktivitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.log_aktivitas_id_seq OWNER TO postgres;

--
-- Name: log_aktivitas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.log_aktivitas_id_seq OWNED BY public.log_aktivitas.id;


--
-- Name: mapel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mapel (
    id bigint NOT NULL,
    nama_mapel character varying(255) NOT NULL,
    kode character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.mapel OWNER TO postgres;

--
-- Name: mapel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mapel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mapel_id_seq OWNER TO postgres;

--
-- Name: mapel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mapel_id_seq OWNED BY public.mapel.id;


--
-- Name: materi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.materi (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    file_path character varying(255) NOT NULL,
    tipe character varying(50) DEFAULT 'materi'::character varying NOT NULL,
    mapel_id bigint NOT NULL,
    kelas_id bigint,
    guru_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.materi OWNER TO postgres;

--
-- Name: materi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.materi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.materi_id_seq OWNER TO postgres;

--
-- Name: materi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.materi_id_seq OWNED BY public.materi.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: nilai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nilai (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    tugas_id bigint,
    mapel_id bigint NOT NULL,
    nilai numeric(5,2) NOT NULL,
    catatan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.nilai OWNER TO postgres;

--
-- Name: nilai_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nilai_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.nilai_id_seq OWNER TO postgres;

--
-- Name: nilai_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nilai_id_seq OWNED BY public.nilai.id;


--
-- Name: olympiad_exams; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.olympiad_exams (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    mapel_id bigint NOT NULL,
    kelas_id bigint,
    guru_id bigint NOT NULL,
    tingkat character varying(50),
    durasi integer NOT NULL,
    jumlah_soal integer DEFAULT 0 NOT NULL,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    approved_by bigint,
    approved_at timestamp(0) without time zone,
    catatan_reject text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT olympiad_exams_status_check CHECK (((status)::text = ANY ((ARRAY['draft'::character varying, 'pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
);


ALTER TABLE public.olympiad_exams OWNER TO postgres;

--
-- Name: COLUMN olympiad_exams.tingkat; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.olympiad_exams.tingkat IS 'kabupaten/provinsi/nasional';


--
-- Name: COLUMN olympiad_exams.durasi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.olympiad_exams.durasi IS 'menit';


--
-- Name: olympiad_exams_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.olympiad_exams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.olympiad_exams_id_seq OWNER TO postgres;

--
-- Name: olympiad_exams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.olympiad_exams_id_seq OWNED BY public.olympiad_exams.id;


--
-- Name: olympiad_jawabans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.olympiad_jawabans (
    id bigint NOT NULL,
    olympiad_exam_id bigint NOT NULL,
    olympiad_soal_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    jawaban text,
    nilai numeric(5,2),
    dinilai boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.olympiad_jawabans OWNER TO postgres;

--
-- Name: olympiad_jawabans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.olympiad_jawabans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.olympiad_jawabans_id_seq OWNER TO postgres;

--
-- Name: olympiad_jawabans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.olympiad_jawabans_id_seq OWNED BY public.olympiad_jawabans.id;


--
-- Name: olympiad_soals; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.olympiad_soals (
    id bigint NOT NULL,
    olympiad_exam_id bigint NOT NULL,
    nomor integer NOT NULL,
    soal text NOT NULL,
    tipe character varying(255) DEFAULT 'pg'::character varying NOT NULL,
    pilihan_a text,
    pilihan_b text,
    pilihan_c text,
    pilihan_d text,
    jawaban_benar character varying(10),
    bobot integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT olympiad_soals_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['pg'::character varying, 'essay'::character varying])::text[])))
);


ALTER TABLE public.olympiad_soals OWNER TO postgres;

--
-- Name: olympiad_soals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.olympiad_soals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.olympiad_soals_id_seq OWNER TO postgres;

--
-- Name: olympiad_soals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.olympiad_soals_id_seq OWNED BY public.olympiad_soals.id;


--
-- Name: orang_tua; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orang_tua (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    nama character varying(255) NOT NULL,
    no_telp character varying(255),
    alamat text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.orang_tua OWNER TO postgres;

--
-- Name: orang_tua_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orang_tua_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orang_tua_id_seq OWNER TO postgres;

--
-- Name: orang_tua_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orang_tua_id_seq OWNED BY public.orang_tua.id;


--
-- Name: orang_tua_siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orang_tua_siswa (
    id bigint NOT NULL,
    orang_tua_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.orang_tua_siswa OWNER TO postgres;

--
-- Name: orang_tua_siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orang_tua_siswa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orang_tua_siswa_id_seq OWNER TO postgres;

--
-- Name: orang_tua_siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orang_tua_siswa_id_seq OWNED BY public.orang_tua_siswa.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: pembayarans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pembayarans (
    id bigint NOT NULL,
    spp_id bigint NOT NULL,
    orang_tua_id bigint NOT NULL,
    tanggal_bayar date NOT NULL,
    jumlah numeric(12,2) NOT NULL,
    metode character varying(50) DEFAULT 'transfer'::character varying NOT NULL,
    bukti character varying(255),
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT pembayarans_status_check CHECK (((status)::text = ANY ((ARRAY['confirmed'::character varying, 'pending'::character varying])::text[])))
);


ALTER TABLE public.pembayarans OWNER TO postgres;

--
-- Name: pembayarans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pembayarans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pembayarans_id_seq OWNER TO postgres;

--
-- Name: pembayarans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pembayarans_id_seq OWNED BY public.pembayarans.id;


--
-- Name: pengaturan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengaturan (
    id bigint NOT NULL,
    key character varying(100) NOT NULL,
    value text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pengaturan OWNER TO postgres;

--
-- Name: pengaturan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengaturan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengaturan_id_seq OWNER TO postgres;

--
-- Name: pengaturan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengaturan_id_seq OWNED BY public.pengaturan.id;


--
-- Name: pengumpulan_tugas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengumpulan_tugas (
    id bigint NOT NULL,
    tugas_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    file_path character varying(255),
    catatan_siswa text,
    nilai numeric(5,2),
    catatan_guru text,
    dikumpulkan_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pengumpulan_tugas OWNER TO postgres;

--
-- Name: pengumpulan_tugas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengumpulan_tugas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengumpulan_tugas_id_seq OWNER TO postgres;

--
-- Name: pengumpulan_tugas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengumpulan_tugas_id_seq OWNED BY public.pengumpulan_tugas.id;


--
-- Name: pengumuman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengumuman (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    konten text NOT NULL,
    created_by bigint NOT NULL,
    target_role character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pengumuman OWNER TO postgres;

--
-- Name: pengumuman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengumuman_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengumuman_id_seq OWNER TO postgres;

--
-- Name: pengumuman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengumuman_id_seq OWNED BY public.pengumuman.id;


--
-- Name: pesan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pesan (
    id bigint NOT NULL,
    pengirim_id bigint NOT NULL,
    penerima_id bigint NOT NULL,
    subjek character varying(255),
    isi text NOT NULL,
    dibaca boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pesan OWNER TO postgres;

--
-- Name: pesan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pesan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pesan_id_seq OWNER TO postgres;

--
-- Name: pesan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pesan_id_seq OWNED BY public.pesan.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.settings (
    id bigint NOT NULL,
    key character varying(255) NOT NULL,
    value text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.settings OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.settings_id_seq OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.settings_id_seq OWNED BY public.settings.id;


--
-- Name: siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    nis character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    kelas_id bigint NOT NULL,
    jenis_kelamin character varying(255) NOT NULL,
    tempat_lahir character varying(255),
    tanggal_lahir date,
    alamat text,
    nama_ayah character varying(255),
    nama_ibu character varying(255),
    status character varying(255) DEFAULT 'aktif'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT siswa_jenis_kelamin_check CHECK (((jenis_kelamin)::text = ANY ((ARRAY['L'::character varying, 'P'::character varying])::text[]))),
    CONSTRAINT siswa_status_check CHECK (((status)::text = ANY ((ARRAY['aktif'::character varying, 'nonaktif'::character varying])::text[])))
);


ALTER TABLE public.siswa OWNER TO postgres;

--
-- Name: siswa_badge; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa_badge (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    badge_id bigint NOT NULL,
    achieved_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.siswa_badge OWNER TO postgres;

--
-- Name: siswa_badge_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.siswa_badge_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.siswa_badge_id_seq OWNER TO postgres;

--
-- Name: siswa_badge_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_badge_id_seq OWNED BY public.siswa_badge.id;


--
-- Name: siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.siswa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.siswa_id_seq OWNER TO postgres;

--
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- Name: spps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spps (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    bulan integer NOT NULL,
    tahun integer NOT NULL,
    jumlah numeric(12,2) NOT NULL,
    tenggat date,
    status character varying(255) DEFAULT 'belum'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT spps_status_check CHECK (((status)::text = ANY ((ARRAY['lunas'::character varying, 'belum'::character varying])::text[])))
);


ALTER TABLE public.spps OWNER TO postgres;

--
-- Name: spps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.spps_id_seq OWNER TO postgres;

--
-- Name: spps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spps_id_seq OWNED BY public.spps.id;


--
-- Name: tahfidz_setoran; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tahfidz_setoran (
    id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    guru_id bigint NOT NULL,
    tanggal date NOT NULL,
    surah character varying(255) NOT NULL,
    ayat_mulai integer NOT NULL,
    ayat_selesai integer NOT NULL,
    jumlah_ayat integer NOT NULL,
    status character varying(255) DEFAULT 'baru'::character varying NOT NULL,
    nilai integer,
    catatan_guru text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT tahfidz_setoran_status_check CHECK (((status)::text = ANY ((ARRAY['baru'::character varying, 'murojaah'::character varying])::text[])))
);


ALTER TABLE public.tahfidz_setoran OWNER TO postgres;

--
-- Name: tahfidz_setoran_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tahfidz_setoran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tahfidz_setoran_id_seq OWNER TO postgres;

--
-- Name: tahfidz_setoran_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tahfidz_setoran_id_seq OWNED BY public.tahfidz_setoran.id;


--
-- Name: tugas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tugas (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    mapel_id bigint NOT NULL,
    kelas_id bigint NOT NULL,
    guru_id bigint NOT NULL,
    tipe character varying(255) DEFAULT 'tugas'::character varying NOT NULL,
    tanggal_deadline date,
    file_path character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT tugas_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['tugas'::character varying, 'ulangan'::character varying])::text[])))
);


ALTER TABLE public.tugas OWNER TO postgres;

--
-- Name: tugas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tugas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tugas_id_seq OWNER TO postgres;

--
-- Name: tugas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tugas_id_seq OWNED BY public.tugas.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255) DEFAULT 'siswa_sd'::character varying NOT NULL,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['siswa_sd'::character varying, 'siswa_smp'::character varying, 'guru'::character varying, 'orang_tua'::character varying, 'admin'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: workbook_jawabans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workbook_jawabans (
    id bigint NOT NULL,
    workbook_soal_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    jawaban text,
    nilai numeric(5,2),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.workbook_jawabans OWNER TO postgres;

--
-- Name: workbook_jawabans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workbook_jawabans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.workbook_jawabans_id_seq OWNER TO postgres;

--
-- Name: workbook_jawabans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workbook_jawabans_id_seq OWNED BY public.workbook_jawabans.id;


--
-- Name: workbook_soals; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workbook_soals (
    id bigint NOT NULL,
    workbook_id bigint NOT NULL,
    nomor integer NOT NULL,
    soal text NOT NULL,
    tipe character varying(255) DEFAULT 'pg'::character varying NOT NULL,
    pilihan_a text,
    pilihan_b text,
    pilihan_c text,
    pilihan_d text,
    jawaban_benar character varying(10),
    bobot integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT workbook_soals_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['pg'::character varying, 'essay'::character varying])::text[])))
);


ALTER TABLE public.workbook_soals OWNER TO postgres;

--
-- Name: workbook_soals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workbook_soals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.workbook_soals_id_seq OWNER TO postgres;

--
-- Name: workbook_soals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workbook_soals_id_seq OWNED BY public.workbook_soals.id;


--
-- Name: workbooks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workbooks (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    mapel_id bigint NOT NULL,
    kelas_id bigint,
    guru_id bigint NOT NULL,
    tipe character varying(255) DEFAULT 'latihan'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT workbooks_tipe_check CHECK (((tipe)::text = ANY ((ARRAY['latihan'::character varying, 'pr'::character varying])::text[])))
);


ALTER TABLE public.workbooks OWNER TO postgres;

--
-- Name: workbooks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workbooks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.workbooks_id_seq OWNER TO postgres;

--
-- Name: workbooks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workbooks_id_seq OWNED BY public.workbooks.id;


--
-- Name: badges id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.badges ALTER COLUMN id SET DEFAULT nextval('public.badges_id_seq'::regclass);


--
-- Name: catatan_wali id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catatan_wali ALTER COLUMN id SET DEFAULT nextval('public.catatan_wali_id_seq'::regclass);


--
-- Name: cbt_exams id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams ALTER COLUMN id SET DEFAULT nextval('public.cbt_exams_id_seq'::regclass);


--
-- Name: cbt_jawabans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans ALTER COLUMN id SET DEFAULT nextval('public.cbt_jawabans_id_seq'::regclass);


--
-- Name: cbt_soals id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_soals ALTER COLUMN id SET DEFAULT nextval('public.cbt_soals_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: guru id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru ALTER COLUMN id SET DEFAULT nextval('public.guru_id_seq'::regclass);


--
-- Name: jadwal id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal ALTER COLUMN id SET DEFAULT nextval('public.jadwal_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: kehadiran id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kehadiran ALTER COLUMN id SET DEFAULT nextval('public.kehadiran_id_seq'::regclass);


--
-- Name: kelas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kelas ALTER COLUMN id SET DEFAULT nextval('public.kelas_id_seq'::regclass);


--
-- Name: log_aktivitas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_aktivitas ALTER COLUMN id SET DEFAULT nextval('public.log_aktivitas_id_seq'::regclass);


--
-- Name: mapel id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mapel ALTER COLUMN id SET DEFAULT nextval('public.mapel_id_seq'::regclass);


--
-- Name: materi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materi ALTER COLUMN id SET DEFAULT nextval('public.materi_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: nilai id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai ALTER COLUMN id SET DEFAULT nextval('public.nilai_id_seq'::regclass);


--
-- Name: olympiad_exams id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams ALTER COLUMN id SET DEFAULT nextval('public.olympiad_exams_id_seq'::regclass);


--
-- Name: olympiad_jawabans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans ALTER COLUMN id SET DEFAULT nextval('public.olympiad_jawabans_id_seq'::regclass);


--
-- Name: olympiad_soals id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_soals ALTER COLUMN id SET DEFAULT nextval('public.olympiad_soals_id_seq'::regclass);


--
-- Name: orang_tua id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua ALTER COLUMN id SET DEFAULT nextval('public.orang_tua_id_seq'::regclass);


--
-- Name: orang_tua_siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua_siswa ALTER COLUMN id SET DEFAULT nextval('public.orang_tua_siswa_id_seq'::regclass);


--
-- Name: pembayarans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayarans ALTER COLUMN id SET DEFAULT nextval('public.pembayarans_id_seq'::regclass);


--
-- Name: pengaturan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengaturan ALTER COLUMN id SET DEFAULT nextval('public.pengaturan_id_seq'::regclass);


--
-- Name: pengumpulan_tugas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumpulan_tugas ALTER COLUMN id SET DEFAULT nextval('public.pengumpulan_tugas_id_seq'::regclass);


--
-- Name: pengumuman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumuman ALTER COLUMN id SET DEFAULT nextval('public.pengumuman_id_seq'::regclass);


--
-- Name: pesan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pesan ALTER COLUMN id SET DEFAULT nextval('public.pesan_id_seq'::regclass);


--
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings ALTER COLUMN id SET DEFAULT nextval('public.settings_id_seq'::regclass);


--
-- Name: siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa ALTER COLUMN id SET DEFAULT nextval('public.siswa_id_seq'::regclass);


--
-- Name: siswa_badge id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_badge ALTER COLUMN id SET DEFAULT nextval('public.siswa_badge_id_seq'::regclass);


--
-- Name: spps id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spps ALTER COLUMN id SET DEFAULT nextval('public.spps_id_seq'::regclass);


--
-- Name: tahfidz_setoran id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tahfidz_setoran ALTER COLUMN id SET DEFAULT nextval('public.tahfidz_setoran_id_seq'::regclass);


--
-- Name: tugas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tugas ALTER COLUMN id SET DEFAULT nextval('public.tugas_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: workbook_jawabans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_jawabans ALTER COLUMN id SET DEFAULT nextval('public.workbook_jawabans_id_seq'::regclass);


--
-- Name: workbook_soals id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_soals ALTER COLUMN id SET DEFAULT nextval('public.workbook_soals_id_seq'::regclass);


--
-- Name: workbooks id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbooks ALTER COLUMN id SET DEFAULT nextval('public.workbooks_id_seq'::regclass);


--
-- Data for Name: badges; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.badges (id, nama, deskripsi, icon, created_at, updated_at) FROM stdin;
1	Rajin Belajar	Aktif 30 hari berturut-turut	⭐	2026-05-29 09:03:51	2026-05-29 09:03:51
2	Juara Quiz	Nilai quiz di atas 90	🎯	2026-05-29 09:03:51	2026-05-29 09:03:51
3	Pembaca Aktif	Baca 20 materi	📖	2026-05-29 09:03:51	2026-05-29 09:03:51
4	Streak 7 Hari	Login 7 hari berturut-turut	🏆	2026-05-29 09:03:51	2026-05-29 09:03:51
5	Hafidz Cilik	Hafal 1 juz Al-Qur'an	📿	2026-05-29 09:03:51	2026-05-29 09:03:51
6	Disiplin	Tidak pernah terlambat 1 bulan	⏰	2026-05-29 09:03:51	2026-05-29 09:03:51
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
lms-al-azhar-jaya-indonesia-cache-budi.smp@alazharjayaindonesia.sch.id|127.0.0.1:timer	i:1780046298;	1780046298
lms-al-azhar-jaya-indonesia-cache-budi.smp@alazharjayaindonesia.sch.id|127.0.0.1	i:1;	1780046298
lms-al-azhar-jaya-indonesia-cache-ahmad@alazharjayaindonesia.sch.id|127.0.0.1:timer	i:1780047122;	1780047122
lms-al-azhar-jaya-indonesia-cache-ahmad@alazharjayaindonesia.sch.id|127.0.0.1	i:1;	1780047122
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: catatan_wali; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.catatan_wali (id, siswa_id, semester, catatan, created_by, created_at, updated_at) FROM stdin;
1	1	Genap 2025/2026	Ananda adalah siswa yang rajin dan memiliki semangat belajar tinggi. Tingkatkan lagi fokus pada mata pelajaran IPS agar nilai lebih maksimal.	1	2026-05-29 09:01:11	2026-05-29 09:01:11
2	2	Genap 2025/2026	Ananda memiliki potensi besar di bidang agama. Pertahankan dan tingkatkan lagi hafalan Al-Qur'an.	1	2026-05-29 09:01:11	2026-05-29 09:01:11
3	3	Genap 2025/2026	Ananda aktif dalam kegiatan kelas, namun perlu lebih teliti dalam mengerjakan soal matematika.	1	2026-05-29 09:01:11	2026-05-29 09:01:11
4	4	Genap 2025/2026	Ananda siswi yang kreatif dan disiplin. Terus kembangkan bakat di bidang seni dan olahraga.	1	2026-05-29 09:01:11	2026-05-29 09:01:11
5	5	Genap 2025/2026	Ananda Doni adalah siswa yang cerdas dan aktif dalam diskusi kelas. Tingkatkan fokus pada pelajaran Bahasa Inggris untuk hasil yang lebih maksimal.	1	2026-05-29 09:18:20	2026-05-29 09:18:20
\.


--
-- Data for Name: cbt_exams; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cbt_exams (id, judul, deskripsi, mapel_id, kelas_id, guru_id, durasi, jumlah_soal, status, approved_by, approved_at, catatan_reject, created_at, updated_at, tipe) FROM stdin;
1	sadasd	\N	3	\N	2	120	1	pending	\N	\N	\N	2026-05-29 10:51:08	2026-05-29 10:51:22	ulangan
\.


--
-- Data for Name: cbt_jawabans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cbt_jawabans (id, cbt_exam_id, cbt_soal_id, siswa_id, jawaban, nilai, dinilai, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: cbt_soals; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cbt_soals (id, cbt_exam_id, nomor, soal, tipe, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, bobot, created_at, updated_at) FROM stdin;
1	1	1	sdas	pg	a	c	c	vb	d	1	2026-05-29 10:51:19	2026-05-29 10:51:19
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: guru; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.guru (id, user_id, nip, nama, mapel_id, alamat, no_telp, status, created_at, updated_at) FROM stdin;
1	1	19870101	Ustadz Ahmad Fauzi	2	\N	\N	aktif	2026-05-29 08:46:46	2026-05-29 08:46:46
2	2	19900215	Bu Dewi Sartika	3	\N	\N	aktif	2026-05-29 08:46:46	2026-05-29 08:46:46
3	3	19910520	Ibu Siti Rahmawati	4	\N	\N	aktif	2026-05-29 08:46:47	2026-05-29 08:46:47
4	4	19881210	Pak Budi Santoso	5	\N	\N	aktif	2026-05-29 08:46:47	2026-05-29 08:46:47
5	5	19920305	Ms. Linda Wijaya	6	\N	\N	aktif	2026-05-29 08:46:47	2026-05-29 08:46:47
6	6	19870712	Pak Dwi Hartono	7	\N	\N	aktif	2026-05-29 08:46:48	2026-05-29 08:46:48
7	11	19850520	Ustadz Hadi Prasetyo	1	\N	\N	aktif	2026-05-29 08:47:26	2026-05-29 08:47:26
8	17	19930815	Bu Fitri Handayani	8	\N	\N	aktif	2026-05-29 08:47:43	2026-05-29 08:47:43
9	18	19890120	Pak Agus Wijaya	9	\N	\N	aktif	2026-05-29 08:47:43	2026-05-29 08:47:43
10	19	19941210	Bu Rina Marlina	10	\N	\N	aktif	2026-05-29 08:47:43	2026-05-29 08:47:43
\.


--
-- Data for Name: jadwal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jadwal (id, kelas_id, mapel_id, guru_id, hari, jam_mulai, jam_selesai, created_at, updated_at) FROM stdin;
1	3	1	7	Senin	06:30:00	07:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
2	3	3	2	Senin	07:30:00	08:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
3	3	4	3	Senin	08:30:00	09:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
4	3	5	4	Senin	10:00:00	11:00:00	2026-05-29 08:47:29	2026-05-29 08:47:29
5	3	2	1	Senin	11:00:00	12:00:00	2026-05-29 08:47:29	2026-05-29 08:47:29
6	3	1	7	Selasa	06:30:00	07:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
7	3	6	5	Selasa	07:30:00	08:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
8	3	3	2	Selasa	08:30:00	09:30:00	2026-05-29 08:47:29	2026-05-29 08:47:29
9	3	7	6	Selasa	10:00:00	11:00:00	2026-05-29 08:47:29	2026-05-29 08:47:29
10	3	8	8	Selasa	11:00:00	12:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
11	3	1	7	Rabu	06:30:00	07:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
12	3	5	4	Rabu	07:30:00	08:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
13	3	4	3	Rabu	08:30:00	09:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
14	3	2	1	Rabu	10:00:00	11:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
15	3	9	9	Rabu	11:00:00	12:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
16	3	1	7	Kamis	06:30:00	07:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
17	3	3	2	Kamis	07:30:00	08:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
18	3	6	5	Kamis	08:30:00	09:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
19	3	7	6	Kamis	10:00:00	11:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
20	3	10	10	Kamis	11:00:00	12:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
21	3	1	7	Jumat	06:30:00	07:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
22	3	2	1	Jumat	07:30:00	08:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
23	3	4	3	Jumat	08:30:00	09:30:00	2026-05-29 08:47:46	2026-05-29 08:47:46
24	3	3	2	Jumat	10:00:00	11:00:00	2026-05-29 08:47:46	2026-05-29 08:47:46
25	6	1	7	Senin	06:30:00	07:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
26	6	3	2	Senin	07:30:00	08:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
27	6	4	3	Senin	08:30:00	09:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
28	6	5	4	Senin	10:00:00	11:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
29	6	2	1	Senin	11:00:00	12:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
30	6	1	7	Selasa	06:30:00	07:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
31	6	6	5	Selasa	07:30:00	08:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
32	6	3	2	Selasa	08:30:00	09:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
33	6	7	6	Selasa	10:00:00	11:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
34	6	8	8	Selasa	11:00:00	12:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
35	6	1	7	Rabu	06:30:00	07:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
36	6	5	4	Rabu	07:30:00	08:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
37	6	4	3	Rabu	08:30:00	09:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
38	6	9	9	Rabu	10:00:00	11:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
39	6	10	10	Rabu	11:00:00	12:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
40	6	1	7	Kamis	06:30:00	07:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
41	6	3	2	Kamis	07:30:00	08:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
42	6	6	5	Kamis	08:30:00	09:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
43	6	7	6	Kamis	10:00:00	11:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
44	6	2	1	Kamis	11:00:00	12:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
45	6	1	7	Jumat	06:30:00	07:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
46	6	2	1	Jumat	07:30:00	08:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
47	6	4	3	Jumat	08:30:00	09:30:00	2026-05-29 09:18:20	2026-05-29 09:18:20
48	6	3	2	Jumat	10:00:00	11:00:00	2026-05-29 09:18:20	2026-05-29 09:18:20
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: kehadiran; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kehadiran (id, siswa_id, tanggal, status, keterangan, created_at, updated_at) FROM stdin;
1	1	2026-01-05	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
2	1	2026-01-06	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
3	1	2026-01-07	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
4	1	2026-01-08	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
5	1	2026-01-09	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
6	1	2026-01-12	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
7	1	2026-01-13	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
8	1	2026-01-14	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
9	1	2026-01-15	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
10	1	2026-01-16	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
11	1	2026-01-19	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
12	1	2026-01-20	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
13	1	2026-01-21	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
14	1	2026-01-22	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
15	1	2026-01-23	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
16	1	2026-01-26	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
17	1	2026-01-27	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
18	1	2026-01-28	izin	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
19	1	2026-01-29	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
20	1	2026-01-30	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
21	1	2026-02-02	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
22	1	2026-02-03	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
23	1	2026-02-04	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
24	1	2026-02-05	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
25	1	2026-02-06	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
26	1	2026-02-09	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
27	1	2026-02-10	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
28	1	2026-02-11	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
29	1	2026-02-12	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
30	1	2026-02-13	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
31	1	2026-02-16	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
32	1	2026-02-17	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
33	1	2026-02-18	izin	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
34	1	2026-02-19	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
35	1	2026-02-20	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
36	1	2026-02-23	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
37	1	2026-02-24	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
38	1	2026-02-25	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
39	1	2026-02-26	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
40	1	2026-02-27	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
41	1	2026-03-02	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
42	1	2026-03-03	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
43	1	2026-03-04	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
44	1	2026-03-05	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
45	1	2026-03-06	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
46	1	2026-03-09	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
47	1	2026-03-10	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
48	1	2026-03-11	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
49	1	2026-03-12	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
50	1	2026-03-13	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
51	1	2026-03-16	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
52	1	2026-03-17	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
53	1	2026-03-18	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
54	1	2026-03-19	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
55	1	2026-03-20	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
56	1	2026-03-23	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
57	1	2026-03-24	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
58	1	2026-03-25	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
59	1	2026-03-26	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
60	1	2026-03-27	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
61	1	2026-03-30	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
62	1	2026-03-31	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
63	1	2026-04-01	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
64	1	2026-04-02	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
65	1	2026-04-03	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
66	1	2026-04-06	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
67	1	2026-04-07	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
68	1	2026-04-08	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
69	1	2026-04-09	sakit	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
70	1	2026-04-10	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
71	1	2026-04-13	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
72	1	2026-04-14	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
73	1	2026-04-15	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
74	1	2026-04-16	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
75	1	2026-04-17	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
76	1	2026-04-20	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
77	1	2026-04-21	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
78	1	2026-04-22	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
79	1	2026-04-23	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
80	1	2026-04-24	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
81	1	2026-04-27	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
82	1	2026-04-28	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
83	1	2026-04-29	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
84	1	2026-04-30	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
85	1	2026-05-01	sakit	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
86	1	2026-05-04	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
87	1	2026-05-05	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
88	1	2026-05-06	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
89	1	2026-05-07	alpha	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
90	1	2026-05-08	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
91	1	2026-05-11	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
92	1	2026-05-12	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
93	1	2026-05-13	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
94	1	2026-05-14	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
95	1	2026-05-15	izin	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
96	1	2026-05-18	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
97	1	2026-05-19	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
98	1	2026-05-20	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
99	1	2026-05-21	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
100	1	2026-05-22	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
101	1	2026-05-25	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
102	1	2026-05-26	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
103	1	2026-05-27	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
104	1	2026-05-28	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
105	1	2026-05-29	hadir	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
106	5	2026-01-05	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
107	5	2026-01-06	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
108	5	2026-01-07	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
109	5	2026-01-08	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
110	5	2026-01-09	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
111	5	2026-01-12	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
112	5	2026-01-13	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
113	5	2026-01-14	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
114	5	2026-01-15	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
115	5	2026-01-16	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
116	5	2026-01-19	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
117	5	2026-01-20	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
118	5	2026-01-21	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
119	5	2026-01-22	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
120	5	2026-01-23	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
121	5	2026-01-26	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
122	5	2026-01-27	alpha	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
123	5	2026-01-28	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
124	5	2026-01-29	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
125	5	2026-01-30	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
126	5	2026-02-02	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
127	5	2026-02-03	izin	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
128	5	2026-02-04	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
129	5	2026-02-05	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
130	5	2026-02-06	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
131	5	2026-02-09	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
132	5	2026-02-10	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
133	5	2026-02-11	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
134	5	2026-02-12	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
135	5	2026-02-13	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
136	5	2026-02-16	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
137	5	2026-02-17	alpha	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
138	5	2026-02-18	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
139	5	2026-02-19	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
140	5	2026-02-20	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
141	5	2026-02-23	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
142	5	2026-02-24	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
143	5	2026-02-25	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
144	5	2026-02-26	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
145	5	2026-02-27	sakit	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
146	5	2026-03-02	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
147	5	2026-03-03	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
148	5	2026-03-04	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
149	5	2026-03-05	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
150	5	2026-03-06	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
151	5	2026-03-09	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
152	5	2026-03-10	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
153	5	2026-03-11	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
154	5	2026-03-12	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
155	5	2026-03-13	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
156	5	2026-03-16	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
157	5	2026-03-17	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
158	5	2026-03-18	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
159	5	2026-03-19	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
160	5	2026-03-20	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
161	5	2026-03-23	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
162	5	2026-03-24	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
163	5	2026-03-25	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
164	5	2026-03-26	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
165	5	2026-03-27	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
166	5	2026-03-30	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
167	5	2026-03-31	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
168	5	2026-04-01	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
169	5	2026-04-02	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
170	5	2026-04-03	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
171	5	2026-04-06	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
172	5	2026-04-07	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
173	5	2026-04-08	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
174	5	2026-04-09	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
175	5	2026-04-10	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
176	5	2026-04-13	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
177	5	2026-04-14	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
178	5	2026-04-15	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
179	5	2026-04-16	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
180	5	2026-04-17	izin	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
181	5	2026-04-20	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
182	5	2026-04-21	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
183	5	2026-04-22	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
184	5	2026-04-23	izin	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
185	5	2026-04-24	sakit	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
186	5	2026-04-27	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
187	5	2026-04-28	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
188	5	2026-04-29	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
189	5	2026-04-30	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
190	5	2026-05-01	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
191	5	2026-05-04	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
192	5	2026-05-05	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
193	5	2026-05-06	sakit	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
194	5	2026-05-07	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
195	5	2026-05-08	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
196	5	2026-05-11	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
197	5	2026-05-12	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
198	5	2026-05-13	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
199	5	2026-05-14	izin	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
200	5	2026-05-15	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
201	5	2026-05-18	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
202	5	2026-05-19	alpha	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
203	5	2026-05-20	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
204	5	2026-05-21	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
205	5	2026-05-22	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
206	5	2026-05-25	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
207	5	2026-05-26	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
208	5	2026-05-27	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
209	5	2026-05-28	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
210	5	2026-05-29	hadir	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
\.


--
-- Data for Name: kelas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kelas (id, nama_kelas, jenjang, created_at, updated_at) FROM stdin;
1	1A	SD	2026-05-29 08:46:45	2026-05-29 08:46:45
2	4B	SD	2026-05-29 08:46:45	2026-05-29 08:46:45
3	7A	SD	2026-05-29 08:46:45	2026-05-29 08:46:45
4	7B	SD	2026-05-29 08:46:45	2026-05-29 08:46:45
5	8A	SMP	2026-05-29 08:46:45	2026-05-29 08:46:45
6	8B	SMP	2026-05-29 08:46:45	2026-05-29 08:46:45
7	9A	SMP	2026-05-29 08:46:45	2026-05-29 08:46:45
8	9B	SMP	2026-05-29 08:46:45	2026-05-29 08:46:45
\.


--
-- Data for Name: log_aktivitas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.log_aktivitas (id, user_id, tipe, deskripsi, status, created_at, updated_at) FROM stdin;
1	16	User	Login admin dashboard	\N	2026-03-25 08:00:00	2026-03-25 08:00:00
2	\N	Sistem	Backup database otomatis	sukses	2026-03-25 02:00:00	2026-03-25 02:00:00
3	16	Kelas	Menambah kelas baru 1A	\N	2026-03-24 10:30:00	2026-03-24 10:30:00
4	16	User	Mendaftarkan siswa baru: Citra Dewi	\N	2026-03-24 09:15:00	2026-03-24 09:15:00
5	2	Tugas	Membuat tugas: PR Persamaan Linear	\N	2026-03-23 14:00:00	2026-03-23 14:00:00
6	16	Laporan	Generate laporan kehadiran bulan Maret	\N	2026-03-22 11:00:00	2026-03-22 11:00:00
\.


--
-- Data for Name: mapel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mapel (id, nama_mapel, kode, created_at, updated_at) FROM stdin;
1	Tahfidz Qur'an	TAH	2026-05-29 08:46:45	2026-05-29 08:46:45
2	Pendidikan Agama Islam	PAI	2026-05-29 08:46:45	2026-05-29 08:46:45
3	Matematika	MTK	2026-05-29 08:46:45	2026-05-29 08:46:45
4	Bahasa Indonesia	B.IND	2026-05-29 08:46:45	2026-05-29 08:46:45
5	IPA	IPA	2026-05-29 08:46:45	2026-05-29 08:46:45
6	Bahasa Inggris	ING	2026-05-29 08:46:45	2026-05-29 08:46:45
7	IPS	IPS	2026-05-29 08:46:45	2026-05-29 08:46:45
8	SBK	SBK	2026-05-29 08:46:45	2026-05-29 08:46:45
9	PJOK	PJOK	2026-05-29 08:46:45	2026-05-29 08:46:45
10	Prakarya	PRAK	2026-05-29 08:46:45	2026-05-29 08:46:45
\.


--
-- Data for Name: materi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.materi (id, judul, deskripsi, file_path, tipe, mapel_id, kelas_id, guru_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_05_29_081457_add_role_to_users_table	1
5	2026_05_29_083954_create_kelas_table	1
6	2026_05_29_084058_create_mapel_table	1
7	2026_05_29_084114_create_siswa_table	1
8	2026_05_29_084129_create_guru_table	1
9	2026_05_29_084158_create_orang_tua_table	2
10	2026_05_29_084209_create_jadwal_table	2
11	2026_05_29_084209_create_orang_tua_siswa_table	2
12	2026_05_29_084210_create_tahfidz_setoran_table	2
13	2026_05_29_084210_create_tugas_table	2
14	2026_05_29_084231_create_nilai_table	3
15	2026_05_29_084231_create_pengumuman_table	3
16	2026_05_29_084231_create_pesan_table	3
17	2026_05_29_085947_create_catatan_wali_table	4
18	2026_05_29_085947_create_kehadiran_table	4
19	2026_05_29_090234_create_badges_table	5
20	2026_05_29_090235_create_siswa_badge_table	5
21	2026_05_29_090641_create_cbt_exams_table	6
22	2026_05_29_090641_create_cbt_soals_table	6
23	2026_05_29_090642_create_cbt_jawabans_table	6
24	2026_05_29_090642_create_olympiad_exams_table	6
25	2026_05_29_090641_create_olympiad_soals_table	7
26	2026_05_29_090642_create_olympiad_jawabans_table	7
28	2026_05_29_091037_create_workbooks_table	8
29	2026_05_29_091038_create_spps_table	8
30	2026_05_29_091038_create_workbook_soals_table	8
31	2026_05_29_091039_create_pembayarans_table	8
32	2026_05_29_091040_create_workbook_jawabans_table	8
33	2026_05_29_091041_create_log_aktivitas_table	8
34	2026_05_29_091041_create_pengaturan_table	8
35	2026_05_29_094118_create_materi_table	9
36	2026_05_29_095608_create_settings_table	10
37	2026_05_29_101731_create_pengumpulan_tugas_table	11
38	2026_05_29_103615_add_tipe_to_cbt_exams_table	12
\.


--
-- Data for Name: nilai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nilai (id, siswa_id, tugas_id, mapel_id, nilai, catatan, created_at, updated_at) FROM stdin;
1	1	\N	1	80.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
2	1	\N	2	92.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
3	1	\N	3	85.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
4	1	\N	4	88.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
5	1	\N	5	90.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
6	1	\N	6	84.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
7	1	\N	7	78.00	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
8	5	\N	1	85.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
9	5	\N	2	88.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
10	5	\N	3	80.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
11	5	\N	4	82.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
12	5	\N	5	90.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
13	5	\N	6	78.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
14	5	\N	7	84.00	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
16	5	\N	8	99.00	\N	2026-05-29 09:45:55	2026-05-29 09:45:55
15	4	\N	3	10.00	\N	2026-05-29 09:45:08	2026-05-29 09:46:24
\.


--
-- Data for Name: olympiad_exams; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.olympiad_exams (id, judul, deskripsi, mapel_id, kelas_id, guru_id, tingkat, durasi, jumlah_soal, status, approved_by, approved_at, catatan_reject, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: olympiad_jawabans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.olympiad_jawabans (id, olympiad_exam_id, olympiad_soal_id, siswa_id, jawaban, nilai, dinilai, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: olympiad_soals; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.olympiad_soals (id, olympiad_exam_id, nomor, soal, tipe, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, bobot, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: orang_tua; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orang_tua (id, user_id, nama, no_telp, alamat, created_at, updated_at) FROM stdin;
1	20	Ibu Sari Rahmawati	\N	\N	2026-05-29 08:47:28	2026-05-29 09:45:32
\.


--
-- Data for Name: orang_tua_siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orang_tua_siswa (id, orang_tua_id, siswa_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	1	2	\N	\N
3	1	3	\N	\N
4	1	4	\N	\N
5	1	5	\N	\N
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pembayarans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pembayarans (id, spp_id, orang_tua_id, tanggal_bayar, jumlah, metode, bukti, status, created_at, updated_at) FROM stdin;
1	1	1	2026-01-05	250000.00	transfer	\N	confirmed	2026-05-29 09:12:51	2026-05-29 09:12:51
2	2	1	2026-02-05	250000.00	transfer	\N	confirmed	2026-05-29 09:12:51	2026-05-29 09:12:51
3	3	1	2026-03-05	250000.00	transfer	\N	confirmed	2026-05-29 09:12:51	2026-05-29 09:12:51
4	4	1	2026-04-05	250000.00	transfer	\N	confirmed	2026-05-29 09:12:51	2026-05-29 09:12:51
\.


--
-- Data for Name: pengaturan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengaturan (id, key, value, created_at, updated_at) FROM stdin;
1	nama_sekolah	SDIT/SMPIT Al Azhar Jaya Indonesia	2026-05-29 09:12:51	2026-05-29 09:12:51
2	tahun_ajaran	2025/2026	2026-05-29 09:12:51	2026-05-29 09:12:51
3	semester	Genap	2026-05-29 09:12:51	2026-05-29 09:12:51
4	alamat_sekolah	Jl. Raya Cendana No. 123, Kota Tangerang Selatan, Banten	2026-05-29 09:12:51	2026-05-29 09:12:51
5	kkm_default	70	2026-05-29 09:12:51	2026-05-29 09:12:51
\.


--
-- Data for Name: pengumpulan_tugas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengumpulan_tugas (id, tugas_id, siswa_id, file_path, catatan_siswa, nilai, catatan_guru, dikumpulkan_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: pengumuman; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengumuman (id, judul, konten, created_by, target_role, created_at, updated_at) FROM stdin;
1	Libur Hari Raya Nyepi	Sekolah libur pada tanggal 30 Maret 2026 dalam rangka Hari Raya Nyepi. Kegiatan belajar diliburkan satu hari penuh.	16	\N	2026-03-25 00:00:00	2026-03-25 00:00:00
2	Pesantren Kilat Ramadhan	Kegiatan pesantren kilat akan diadakan pada minggu kedua April. Harap persiapkan diri dan membawa perlengkapan ibadah.	16	\N	2026-03-20 00:00:00	2026-03-20 00:00:00
3	Pembagian Rapor Tengah Semester	Pembagian rapor akan dilaksanakan pada 5 April 2026 pukul 08.00 WIB di aula sekolah.	16	\N	2026-03-15 00:00:00	2026-03-15 00:00:00
\.


--
-- Data for Name: pesan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pesan (id, pengirim_id, penerima_id, subjek, isi, dibaca, created_at, updated_at) FROM stdin;
1	2	7	PR Matematika	Jangan lupa kumpulkan PR besok!	f	2026-05-29 08:47:46	2026-05-29 08:47:46
2	2	7	Pesantren Kilat	Informasi jadwal pesantren kilat...	f	2026-05-29 08:47:46	2026-05-29 08:47:46
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
ygq3Yrdi0Xs5N0uGUEpGHzy4CKrRoUDvXjlDYAhd	\N	127.0.0.1	curl/8.20.0	eyJfdG9rZW4iOiJKdFdZMm1wenROd1NDcmFSMUY5d1ZxbnoxbHhacVRkcjY0ZUducEFiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MTAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==	1780045447
eKedNfcuoKyraOBmGrXOL2qrwNvrGT7FApOlpsQ0	\N	127.0.0.1	Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0	eyJfdG9rZW4iOiJjZm1wanE3SW9BcWFGVGRKUWM5cHlJT0xQdkl2c2RyWVJsYXlPMldDIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgxMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==	1780051887
\.


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.settings (id, key, value, created_at, updated_at) FROM stdin;
1	kkm_sd	70	\N	\N
2	kkm_smp	75	\N	\N
3	school_name	Al Azhar Jaya Indonesia	\N	\N
4	semester_aktif	Genap 2025/2026	\N	\N
5	alamat_sekolah	Jl. Al Azhar No. 1, Bekasi	\N	\N
\.


--
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, user_id, nis, nama, kelas_id, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, nama_ayah, nama_ibu, status, created_at, updated_at) FROM stdin;
1	7	2024001	Ahmad Rizky	3	L	\N	\N	\N	\N	\N	aktif	2026-05-29 08:46:48	2026-05-29 08:46:48
2	8	2024002	Siti Aisyah	3	P	\N	\N	\N	\N	\N	aktif	2026-05-29 08:46:48	2026-05-29 08:46:48
3	12	2024003	Budi Santoso	3	L	\N	\N	\N	\N	\N	aktif	2026-05-29 08:47:27	2026-05-29 08:47:27
4	13	2024004	Citra Dewi	3	P	\N	\N	\N	\N	\N	aktif	2026-05-29 08:47:28	2026-05-29 08:47:28
5	14	2023101	Doni Prasetyo	6	L	\N	\N	\N	\N	\N	aktif	2026-05-29 08:47:28	2026-05-29 09:18:01
\.


--
-- Data for Name: siswa_badge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa_badge (id, siswa_id, badge_id, achieved_at) FROM stdin;
1	1	1	2026-05-29 16:03:52
2	1	2	2026-05-29 16:03:52
3	1	5	2026-05-29 16:03:52
4	2	1	2026-05-29 16:03:52
\.


--
-- Data for Name: spps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spps (id, siswa_id, bulan, tahun, jumlah, tenggat, status, created_at, updated_at) FROM stdin;
1	1	1	2026	250000.00	2026-01-10	lunas	2026-05-29 09:12:51	2026-05-29 09:12:51
2	1	2	2026	250000.00	2026-02-10	lunas	2026-05-29 09:12:51	2026-05-29 09:12:51
3	1	3	2026	250000.00	2026-03-10	lunas	2026-05-29 09:12:51	2026-05-29 09:12:51
4	1	4	2026	250000.00	2026-04-10	lunas	2026-05-29 09:12:51	2026-05-29 09:12:51
5	1	5	2026	250000.00	2026-05-10	belum	2026-05-29 09:12:51	2026-05-29 09:12:51
\.


--
-- Data for Name: tahfidz_setoran; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tahfidz_setoran (id, siswa_id, guru_id, tanggal, surah, ayat_mulai, ayat_selesai, jumlah_ayat, status, nilai, catatan_guru, created_at, updated_at) FROM stdin;
1	1	7	2026-03-10	An-Naba'	1	10	10	baru	85	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
2	1	7	2026-03-18	An-Naba'	11	20	10	baru	90	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
3	1	7	2026-03-11	An-Nazi'at	1	15	15	baru	82	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
4	1	7	2026-03-19	An-Naba'	1	10	10	murojaah	92	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
5	2	7	2026-03-13	An-Naba'	1	8	8	baru	88	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
6	1	7	2026-03-11	An-Naba'	1	10	10	baru	85	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
7	1	7	2026-03-05	An-Naba'	11	20	10	baru	90	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
8	1	7	2026-03-22	An-Nazi'at	1	15	15	baru	82	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
9	1	7	2026-03-27	An-Naba'	1	10	10	murojaah	92	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
10	2	7	2026-03-16	An-Naba'	1	8	8	baru	88	\N	2026-05-29 09:01:11	2026-05-29 09:01:11
11	1	7	2026-03-16	An-Naba'	1	10	10	baru	85	\N	2026-05-29 09:03:51	2026-05-29 09:03:51
12	1	7	2026-03-26	An-Naba'	11	20	10	baru	90	\N	2026-05-29 09:03:51	2026-05-29 09:03:51
13	1	7	2026-03-02	An-Nazi'at	1	15	15	baru	82	\N	2026-05-29 09:03:51	2026-05-29 09:03:51
14	1	7	2026-03-13	An-Naba'	1	10	10	murojaah	92	\N	2026-05-29 09:03:51	2026-05-29 09:03:51
15	2	7	2026-03-11	An-Naba'	1	8	8	baru	88	\N	2026-05-29 09:03:51	2026-05-29 09:03:51
16	1	7	2026-03-11	An-Naba'	1	10	10	baru	85	\N	2026-05-29 09:12:51	2026-05-29 09:12:51
17	1	7	2026-03-07	An-Naba'	11	20	10	baru	90	\N	2026-05-29 09:12:51	2026-05-29 09:12:51
18	1	7	2026-03-10	An-Nazi'at	1	15	15	baru	82	\N	2026-05-29 09:12:51	2026-05-29 09:12:51
19	1	7	2026-03-20	An-Naba'	1	10	10	murojaah	92	\N	2026-05-29 09:12:51	2026-05-29 09:12:51
20	2	7	2026-03-25	An-Naba'	1	8	8	baru	88	\N	2026-05-29 09:12:51	2026-05-29 09:12:51
21	5	7	2026-03-18	An-Naba'	1	10	10	baru	85	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
22	5	7	2026-03-14	An-Naba'	11	20	10	baru	88	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
23	5	7	2026-03-08	An-Nazi'at	1	10	10	murojaah	90	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
\.


--
-- Data for Name: tugas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tugas (id, judul, deskripsi, mapel_id, kelas_id, guru_id, tipe, tanggal_deadline, file_path, created_at, updated_at) FROM stdin;
1	Tugas Praktek Sholat	\N	2	3	1	tugas	2026-04-02	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
2	PR Persamaan Linear	\N	3	3	2	tugas	2026-04-05	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
3	Laporan Pengamatan	\N	5	3	4	tugas	2026-04-10	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
4	Esai Liburan	\N	4	3	3	tugas	2026-04-15	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
5	Vocabulary Quiz	\N	6	3	5	tugas	2026-04-12	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
6	Ulangan Harian Bab 4	\N	4	3	3	ulangan	2026-04-08	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
7	UTS Genap	\N	5	3	4	ulangan	2026-04-20	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
8	Ulangan Harian Bab 3	\N	3	3	2	ulangan	2026-03-15	\N	2026-05-29 08:47:46	2026-05-29 08:47:46
9	Tugas Praktek Sholat	\N	2	6	1	tugas	2026-04-02	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
10	PR Persamaan Linear	\N	3	6	2	tugas	2026-04-05	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
11	Laporan Pengamatan	\N	5	6	4	tugas	2026-04-10	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
12	Esai Liburan	\N	4	6	3	tugas	2026-04-15	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
13	Vocabulary Quiz	\N	6	6	5	tugas	2026-04-12	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
14	Ulangan Harian Bab 4	\N	4	6	3	ulangan	2026-04-08	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
15	UTS Genap	\N	5	6	4	ulangan	2026-04-20	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
16	Ulangan Harian Bab 3	\N	3	6	2	ulangan	2026-03-15	\N	2026-05-29 09:18:20	2026-05-29 09:18:20
17	fdfs	df	3	1	2	ulangan	2026-06-05	\N	2026-05-29 10:41:58	2026-05-29 10:41:58
18	sdfds	fdsf	3	6	2	ulangan	2026-06-05	\N	2026-05-29 10:43:13	2026-05-29 10:43:13
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) FROM stdin;
1	Ustadz Ahmad Fauzi	ahmad.fauzi@alazharjayaindonesia.sch.id	\N	$2y$12$sijlPyzY8bjGC1j80xL6Y.iN4nULtEt/rN.6QVFXC87eiCpEsc13m	\N	2026-05-29 08:46:46	2026-05-29 08:46:46	guru
2	Bu Dewi Sartika	dewi.sartika@alazharjayaindonesia.sch.id	\N	$2y$12$3W7bstNk7EihJaCnsSDMx.j7mmCn2.6nYMC5.NCxhUgTKUgalgqtq	\N	2026-05-29 08:46:46	2026-05-29 08:46:46	guru
3	Ibu Siti Rahmawati	siti.rahmawati@alazharjayaindonesia.sch.id	\N	$2y$12$wJRRT7rw/mY1URl7VuO4UOYnojeIKIsQSOYmEvQpm5BUrDJXMrwBq	\N	2026-05-29 08:46:47	2026-05-29 08:46:47	guru
4	Pak Budi Santoso	budi.santoso@alazharjayaindonesia.sch.id	\N	$2y$12$gjG8Js9.CzpVjOEiyH/gb.cT/72Zh/3BALJbM2usbctIfG.mRIH8m	\N	2026-05-29 08:46:47	2026-05-29 08:46:47	guru
5	Ms. Linda Wijaya	linda.wijaya@alazharjayaindonesia.sch.id	\N	$2y$12$7u9SG7C8xJ/dmkI96vwLL.60QUiuWFEDUF41EJPpyCwVRRPX9drg2	\N	2026-05-29 08:46:47	2026-05-29 08:46:47	guru
6	Pak Dwi Hartono	dwi.hartono@alazharjayaindonesia.sch.id	\N	$2y$12$fpv3O5sYgLtT2AdIDzGdM.aRS.y1VaHl/B/RDA4Yn.9QJ6IkgYbWm	\N	2026-05-29 08:46:48	2026-05-29 08:46:48	guru
7	Ahmad Rizky	ahmad.rizky@alazharjayaindonesia.sch.id	\N	$2y$12$AfXZyE5ocEJfqqwxtm4aqOpmG/NyBW5FaZG4J6xk3FVi2T6PH07tC	\N	2026-05-29 08:46:48	2026-05-29 08:46:48	siswa_sd
8	Siti Aisyah	siti.aisyah@alazharjayaindonesia.sch.id	\N	$2y$12$xXKySPioM6j5lXjwnjLhme87m2Wn2KxGgd5aE69hrp5jYkPc56jP.	\N	2026-05-29 08:46:48	2026-05-29 08:46:48	siswa_sd
10	Pak Budi Santoso	budi.santoso.guru@alazharjayaindonesia.sch.id	\N	$2y$12$Z92A3HqeFWAYf05oWPPyiubg.znCOUiEy8/cX1TCKlxjHlqB0mcjW	\N	2026-05-29 08:47:25	2026-05-29 08:47:25	guru
11	Ustadz Hadi Prasetyo	hadi.prasetyo@alazharjayaindonesia.sch.id	\N	$2y$12$mOASqTb/OX9f4lQSbzRe0uEc07erm4jjuIBCThNyv7CG4/5QV3rJy	\N	2026-05-29 08:47:26	2026-05-29 08:47:26	guru
12	Budi Santoso	budi.siswa@alazharjayaindonesia.sch.id	\N	$2y$12$duInwfDJOCwkXeK82OTI4OqvzChxwX987u/f8Xra.7C2ZodzczgHK	\N	2026-05-29 08:47:27	2026-05-29 08:47:27	siswa_sd
13	Citra Dewi	citra.dewi@alazharjayaindonesia.sch.id	\N	$2y$12$N4wnJcqk5c4kjU/Nd3fID.JTJjQz.0rqpqFLteUAK8HLfqpiRQbfi	\N	2026-05-29 08:47:28	2026-05-29 08:47:28	siswa_sd
14	Doni Prasetyo	doni.prasetyo@alazharjayaindonesia.sch.id	\N	$2y$12$5wlQf0CY/vp7ToPKtX.kU./4XSfQKpk7f25QHBg29MlHlOyHNDrMy	\N	2026-05-29 08:47:28	2026-05-29 08:47:28	siswa_smp
15	Ibu Sari Rahmawati	sari.rohmah@email.com	\N	$2y$12$X0VWFsjPfnYxZKgW9h89KezrgrTWLcfLXw0Q4a0psYEDOUGFBC3XO	\N	2026-05-29 08:47:28	2026-05-29 08:47:28	orang_tua
16	Admin Sekolah	admin@alazharjayaindonesia.sch.id	\N	$2y$12$tpFq1T4XWUD8h4IJO/orCeNb3VCpZ2Y0tuPHIpCoC29lHSVzhFkOi	\N	2026-05-29 08:47:29	2026-05-29 08:47:29	admin
17	Bu Fitri Handayani	fitri.handayani@alazharjayaindonesia.sch.id	\N	$2y$12$1yqhF/329/AMqxKpOr64De4OotX3nxiDsDV0uV5Ca5ZpYBKUw0b8a	\N	2026-05-29 08:47:43	2026-05-29 08:47:43	guru
18	Pak Agus Wijaya	agus.wijaya@alazharjayaindonesia.sch.id	\N	$2y$12$jUihB3quV.msFbbMUqMKu.HWeq3Fr0ewkGwdRqOGPQ5RJ.wUBxKXu	\N	2026-05-29 08:47:43	2026-05-29 08:47:43	guru
19	Bu Rina Marlina	rina.marlina@alazharjayaindonesia.sch.id	\N	$2y$12$wupPLOe1HjtdOIjP3cLLpOovObiurCGyxWuxohNAxR0YHrNCsrXgu	\N	2026-05-29 08:47:43	2026-05-29 08:47:43	guru
20	Ibu Sari Rahmawati	sari.rohmah@alazharjayaindonesia.sch.id	\N	$2y$12$tMgaMJ.dBKRxRuVN4hVk..Hqm9pvvFqPSzRUPOjRGkY1VVZBHu0Wm	\N	2026-05-29 09:45:32	2026-05-29 09:45:32	orang_tua
\.


--
-- Data for Name: workbook_jawabans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workbook_jawabans (id, workbook_soal_id, siswa_id, jawaban, nilai, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: workbook_soals; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workbook_soals (id, workbook_id, nomor, soal, tipe, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, bobot, created_at, updated_at) FROM stdin;
1	1	1	Berapakah hasil dari 25 × 4?	pg	80	100	120	90	b	1	2026-05-29 09:12:51	2026-05-29 09:12:51
2	1	2	Sebutkan rumus luas persegi panjang!	essay	\N	\N	\N	\N	\N	2	2026-05-29 09:12:51	2026-05-29 09:12:51
3	2	1	Apa sinonim dari kata "rajin"?	pg	Malas	Tekun	Cepat	Lambat	b	1	2026-05-29 09:12:51	2026-05-29 09:12:51
4	3	1	bewfdsoifbiwef	pg	\N	\N	\N	\N	a	1	2026-05-29 10:46:11	2026-05-29 10:46:11
\.


--
-- Data for Name: workbooks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workbooks (id, judul, deskripsi, mapel_id, kelas_id, guru_id, tipe, created_at, updated_at) FROM stdin;
1	Latihan Soal Matematika Bab 5	\N	3	3	2	latihan	2026-05-29 09:12:51	2026-05-29 09:12:51
2	PR Bahasa Indonesia	\N	4	3	3	pr	2026-05-29 09:12:51	2026-05-29 09:12:51
3	dfsfs	jsbdfs	3	\N	2	latihan	2026-05-29 10:45:41	2026-05-29 10:45:41
4	xxxxxx	xsxxsxs	3	\N	2	latihan	2026-05-29 10:50:38	2026-05-29 10:50:38
\.


--
-- Name: badges_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.badges_id_seq', 6, true);


--
-- Name: catatan_wali_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.catatan_wali_id_seq', 5, true);


--
-- Name: cbt_exams_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cbt_exams_id_seq', 1, true);


--
-- Name: cbt_jawabans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cbt_jawabans_id_seq', 1, false);


--
-- Name: cbt_soals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cbt_soals_id_seq', 1, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: guru_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.guru_id_seq', 10, true);


--
-- Name: jadwal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jadwal_id_seq', 48, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: kehadiran_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kehadiran_id_seq', 210, true);


--
-- Name: kelas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kelas_id_seq', 8, true);


--
-- Name: log_aktivitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.log_aktivitas_id_seq', 6, true);


--
-- Name: mapel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mapel_id_seq', 10, true);


--
-- Name: materi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.materi_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 38, true);


--
-- Name: nilai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nilai_id_seq', 16, true);


--
-- Name: olympiad_exams_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.olympiad_exams_id_seq', 1, false);


--
-- Name: olympiad_jawabans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.olympiad_jawabans_id_seq', 1, false);


--
-- Name: olympiad_soals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.olympiad_soals_id_seq', 1, false);


--
-- Name: orang_tua_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orang_tua_id_seq', 1, true);


--
-- Name: orang_tua_siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orang_tua_siswa_id_seq', 5, true);


--
-- Name: pembayarans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pembayarans_id_seq', 4, true);


--
-- Name: pengaturan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengaturan_id_seq', 5, true);


--
-- Name: pengumpulan_tugas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengumpulan_tugas_id_seq', 1, false);


--
-- Name: pengumuman_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengumuman_id_seq', 3, true);


--
-- Name: pesan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pesan_id_seq', 2, true);


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.settings_id_seq', 5, true);


--
-- Name: siswa_badge_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_badge_id_seq', 4, true);


--
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 5, true);


--
-- Name: spps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.spps_id_seq', 5, true);


--
-- Name: tahfidz_setoran_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tahfidz_setoran_id_seq', 23, true);


--
-- Name: tugas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tugas_id_seq', 18, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 20, true);


--
-- Name: workbook_jawabans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workbook_jawabans_id_seq', 1, false);


--
-- Name: workbook_soals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workbook_soals_id_seq', 4, true);


--
-- Name: workbooks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workbooks_id_seq', 4, true);


--
-- Name: badges badges_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.badges
    ADD CONSTRAINT badges_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: catatan_wali catatan_wali_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catatan_wali
    ADD CONSTRAINT catatan_wali_pkey PRIMARY KEY (id);


--
-- Name: cbt_exams cbt_exams_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams
    ADD CONSTRAINT cbt_exams_pkey PRIMARY KEY (id);


--
-- Name: cbt_jawabans cbt_jawabans_cbt_soal_id_siswa_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans
    ADD CONSTRAINT cbt_jawabans_cbt_soal_id_siswa_id_unique UNIQUE (cbt_soal_id, siswa_id);


--
-- Name: cbt_jawabans cbt_jawabans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans
    ADD CONSTRAINT cbt_jawabans_pkey PRIMARY KEY (id);


--
-- Name: cbt_soals cbt_soals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_soals
    ADD CONSTRAINT cbt_soals_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: guru guru_nip_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_nip_unique UNIQUE (nip);


--
-- Name: guru guru_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_pkey PRIMARY KEY (id);


--
-- Name: jadwal jadwal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: kehadiran kehadiran_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kehadiran
    ADD CONSTRAINT kehadiran_pkey PRIMARY KEY (id);


--
-- Name: kehadiran kehadiran_siswa_id_tanggal_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kehadiran
    ADD CONSTRAINT kehadiran_siswa_id_tanggal_unique UNIQUE (siswa_id, tanggal);


--
-- Name: kelas kelas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id);


--
-- Name: log_aktivitas log_aktivitas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_aktivitas
    ADD CONSTRAINT log_aktivitas_pkey PRIMARY KEY (id);


--
-- Name: mapel mapel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mapel
    ADD CONSTRAINT mapel_pkey PRIMARY KEY (id);


--
-- Name: materi materi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materi
    ADD CONSTRAINT materi_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: nilai nilai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_pkey PRIMARY KEY (id);


--
-- Name: olympiad_exams olympiad_exams_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams
    ADD CONSTRAINT olympiad_exams_pkey PRIMARY KEY (id);


--
-- Name: olympiad_jawabans olympiad_jawabans_olympiad_soal_id_siswa_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans
    ADD CONSTRAINT olympiad_jawabans_olympiad_soal_id_siswa_id_unique UNIQUE (olympiad_soal_id, siswa_id);


--
-- Name: olympiad_jawabans olympiad_jawabans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans
    ADD CONSTRAINT olympiad_jawabans_pkey PRIMARY KEY (id);


--
-- Name: olympiad_soals olympiad_soals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_soals
    ADD CONSTRAINT olympiad_soals_pkey PRIMARY KEY (id);


--
-- Name: orang_tua orang_tua_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua
    ADD CONSTRAINT orang_tua_pkey PRIMARY KEY (id);


--
-- Name: orang_tua_siswa orang_tua_siswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua_siswa
    ADD CONSTRAINT orang_tua_siswa_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: pembayarans pembayarans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayarans
    ADD CONSTRAINT pembayarans_pkey PRIMARY KEY (id);


--
-- Name: pengaturan pengaturan_key_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengaturan
    ADD CONSTRAINT pengaturan_key_unique UNIQUE (key);


--
-- Name: pengaturan pengaturan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengaturan
    ADD CONSTRAINT pengaturan_pkey PRIMARY KEY (id);


--
-- Name: pengumpulan_tugas pengumpulan_tugas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumpulan_tugas
    ADD CONSTRAINT pengumpulan_tugas_pkey PRIMARY KEY (id);


--
-- Name: pengumpulan_tugas pengumpulan_tugas_tugas_id_siswa_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumpulan_tugas
    ADD CONSTRAINT pengumpulan_tugas_tugas_id_siswa_id_unique UNIQUE (tugas_id, siswa_id);


--
-- Name: pengumuman pengumuman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumuman
    ADD CONSTRAINT pengumuman_pkey PRIMARY KEY (id);


--
-- Name: pesan pesan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pesan
    ADD CONSTRAINT pesan_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: settings settings_key_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_key_unique UNIQUE (key);


--
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: siswa_badge siswa_badge_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_badge
    ADD CONSTRAINT siswa_badge_pkey PRIMARY KEY (id);


--
-- Name: siswa_badge siswa_badge_siswa_id_badge_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_badge
    ADD CONSTRAINT siswa_badge_siswa_id_badge_id_unique UNIQUE (siswa_id, badge_id);


--
-- Name: siswa siswa_nis_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_nis_unique UNIQUE (nis);


--
-- Name: siswa siswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (id);


--
-- Name: spps spps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spps
    ADD CONSTRAINT spps_pkey PRIMARY KEY (id);


--
-- Name: spps spps_siswa_id_bulan_tahun_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spps
    ADD CONSTRAINT spps_siswa_id_bulan_tahun_unique UNIQUE (siswa_id, bulan, tahun);


--
-- Name: tahfidz_setoran tahfidz_setoran_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tahfidz_setoran
    ADD CONSTRAINT tahfidz_setoran_pkey PRIMARY KEY (id);


--
-- Name: tugas tugas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tugas
    ADD CONSTRAINT tugas_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: workbook_jawabans workbook_jawabans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_jawabans
    ADD CONSTRAINT workbook_jawabans_pkey PRIMARY KEY (id);


--
-- Name: workbook_jawabans workbook_jawabans_workbook_soal_id_siswa_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_jawabans
    ADD CONSTRAINT workbook_jawabans_workbook_soal_id_siswa_id_unique UNIQUE (workbook_soal_id, siswa_id);


--
-- Name: workbook_soals workbook_soals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_soals
    ADD CONSTRAINT workbook_soals_pkey PRIMARY KEY (id);


--
-- Name: workbooks workbooks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbooks
    ADD CONSTRAINT workbooks_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: failed_jobs_connection_queue_failed_at_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX failed_jobs_connection_queue_failed_at_index ON public.failed_jobs USING btree (connection, queue, failed_at);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: catatan_wali catatan_wali_created_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catatan_wali
    ADD CONSTRAINT catatan_wali_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.guru(id);


--
-- Name: catatan_wali catatan_wali_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catatan_wali
    ADD CONSTRAINT catatan_wali_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: cbt_exams cbt_exams_approved_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams
    ADD CONSTRAINT cbt_exams_approved_by_foreign FOREIGN KEY (approved_by) REFERENCES public.users(id);


--
-- Name: cbt_exams cbt_exams_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams
    ADD CONSTRAINT cbt_exams_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id);


--
-- Name: cbt_exams cbt_exams_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams
    ADD CONSTRAINT cbt_exams_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id);


--
-- Name: cbt_exams cbt_exams_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_exams
    ADD CONSTRAINT cbt_exams_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id);


--
-- Name: cbt_jawabans cbt_jawabans_cbt_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans
    ADD CONSTRAINT cbt_jawabans_cbt_exam_id_foreign FOREIGN KEY (cbt_exam_id) REFERENCES public.cbt_exams(id) ON DELETE CASCADE;


--
-- Name: cbt_jawabans cbt_jawabans_cbt_soal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans
    ADD CONSTRAINT cbt_jawabans_cbt_soal_id_foreign FOREIGN KEY (cbt_soal_id) REFERENCES public.cbt_soals(id) ON DELETE CASCADE;


--
-- Name: cbt_jawabans cbt_jawabans_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_jawabans
    ADD CONSTRAINT cbt_jawabans_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: cbt_soals cbt_soals_cbt_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cbt_soals
    ADD CONSTRAINT cbt_soals_cbt_exam_id_foreign FOREIGN KEY (cbt_exam_id) REFERENCES public.cbt_exams(id) ON DELETE CASCADE;


--
-- Name: guru guru_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id) ON DELETE SET NULL;


--
-- Name: guru guru_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guru
    ADD CONSTRAINT guru_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: jadwal jadwal_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id) ON DELETE CASCADE;


--
-- Name: jadwal jadwal_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id) ON DELETE CASCADE;


--
-- Name: jadwal jadwal_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jadwal
    ADD CONSTRAINT jadwal_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id) ON DELETE CASCADE;


--
-- Name: kehadiran kehadiran_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kehadiran
    ADD CONSTRAINT kehadiran_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: log_aktivitas log_aktivitas_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_aktivitas
    ADD CONSTRAINT log_aktivitas_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: materi materi_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materi
    ADD CONSTRAINT materi_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id);


--
-- Name: materi materi_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materi
    ADD CONSTRAINT materi_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id);


--
-- Name: materi materi_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materi
    ADD CONSTRAINT materi_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id);


--
-- Name: nilai nilai_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id) ON DELETE CASCADE;


--
-- Name: nilai nilai_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: nilai nilai_tugas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_tugas_id_foreign FOREIGN KEY (tugas_id) REFERENCES public.tugas(id) ON DELETE CASCADE;


--
-- Name: olympiad_exams olympiad_exams_approved_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams
    ADD CONSTRAINT olympiad_exams_approved_by_foreign FOREIGN KEY (approved_by) REFERENCES public.users(id);


--
-- Name: olympiad_exams olympiad_exams_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams
    ADD CONSTRAINT olympiad_exams_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id);


--
-- Name: olympiad_exams olympiad_exams_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams
    ADD CONSTRAINT olympiad_exams_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id);


--
-- Name: olympiad_exams olympiad_exams_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_exams
    ADD CONSTRAINT olympiad_exams_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id);


--
-- Name: olympiad_jawabans olympiad_jawabans_olympiad_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans
    ADD CONSTRAINT olympiad_jawabans_olympiad_exam_id_foreign FOREIGN KEY (olympiad_exam_id) REFERENCES public.olympiad_exams(id) ON DELETE CASCADE;


--
-- Name: olympiad_jawabans olympiad_jawabans_olympiad_soal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans
    ADD CONSTRAINT olympiad_jawabans_olympiad_soal_id_foreign FOREIGN KEY (olympiad_soal_id) REFERENCES public.olympiad_soals(id) ON DELETE CASCADE;


--
-- Name: olympiad_jawabans olympiad_jawabans_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_jawabans
    ADD CONSTRAINT olympiad_jawabans_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: olympiad_soals olympiad_soals_olympiad_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.olympiad_soals
    ADD CONSTRAINT olympiad_soals_olympiad_exam_id_foreign FOREIGN KEY (olympiad_exam_id) REFERENCES public.olympiad_exams(id) ON DELETE CASCADE;


--
-- Name: orang_tua_siswa orang_tua_siswa_orang_tua_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua_siswa
    ADD CONSTRAINT orang_tua_siswa_orang_tua_id_foreign FOREIGN KEY (orang_tua_id) REFERENCES public.orang_tua(id) ON DELETE CASCADE;


--
-- Name: orang_tua_siswa orang_tua_siswa_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua_siswa
    ADD CONSTRAINT orang_tua_siswa_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: orang_tua orang_tua_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orang_tua
    ADD CONSTRAINT orang_tua_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: pembayarans pembayarans_orang_tua_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayarans
    ADD CONSTRAINT pembayarans_orang_tua_id_foreign FOREIGN KEY (orang_tua_id) REFERENCES public.orang_tua(id);


--
-- Name: pembayarans pembayarans_spp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayarans
    ADD CONSTRAINT pembayarans_spp_id_foreign FOREIGN KEY (spp_id) REFERENCES public.spps(id);


--
-- Name: pengumpulan_tugas pengumpulan_tugas_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumpulan_tugas
    ADD CONSTRAINT pengumpulan_tugas_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: pengumpulan_tugas pengumpulan_tugas_tugas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumpulan_tugas
    ADD CONSTRAINT pengumpulan_tugas_tugas_id_foreign FOREIGN KEY (tugas_id) REFERENCES public.tugas(id) ON DELETE CASCADE;


--
-- Name: pengumuman pengumuman_created_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumuman
    ADD CONSTRAINT pengumuman_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: pesan pesan_penerima_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pesan
    ADD CONSTRAINT pesan_penerima_id_foreign FOREIGN KEY (penerima_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: pesan pesan_pengirim_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pesan
    ADD CONSTRAINT pesan_pengirim_id_foreign FOREIGN KEY (pengirim_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: siswa_badge siswa_badge_badge_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_badge
    ADD CONSTRAINT siswa_badge_badge_id_foreign FOREIGN KEY (badge_id) REFERENCES public.badges(id) ON DELETE CASCADE;


--
-- Name: siswa_badge siswa_badge_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa_badge
    ADD CONSTRAINT siswa_badge_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: siswa siswa_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id) ON DELETE CASCADE;


--
-- Name: siswa siswa_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: spps spps_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spps
    ADD CONSTRAINT spps_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: tahfidz_setoran tahfidz_setoran_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tahfidz_setoran
    ADD CONSTRAINT tahfidz_setoran_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id) ON DELETE CASCADE;


--
-- Name: tahfidz_setoran tahfidz_setoran_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tahfidz_setoran
    ADD CONSTRAINT tahfidz_setoran_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id) ON DELETE CASCADE;


--
-- Name: tugas tugas_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tugas
    ADD CONSTRAINT tugas_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id) ON DELETE CASCADE;


--
-- Name: tugas tugas_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tugas
    ADD CONSTRAINT tugas_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id) ON DELETE CASCADE;


--
-- Name: tugas tugas_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tugas
    ADD CONSTRAINT tugas_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id) ON DELETE CASCADE;


--
-- Name: workbook_jawabans workbook_jawabans_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_jawabans
    ADD CONSTRAINT workbook_jawabans_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: workbook_jawabans workbook_jawabans_workbook_soal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_jawabans
    ADD CONSTRAINT workbook_jawabans_workbook_soal_id_foreign FOREIGN KEY (workbook_soal_id) REFERENCES public.workbook_soals(id) ON DELETE CASCADE;


--
-- Name: workbook_soals workbook_soals_workbook_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbook_soals
    ADD CONSTRAINT workbook_soals_workbook_id_foreign FOREIGN KEY (workbook_id) REFERENCES public.workbooks(id) ON DELETE CASCADE;


--
-- Name: workbooks workbooks_guru_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbooks
    ADD CONSTRAINT workbooks_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES public.guru(id);


--
-- Name: workbooks workbooks_kelas_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbooks
    ADD CONSTRAINT workbooks_kelas_id_foreign FOREIGN KEY (kelas_id) REFERENCES public.kelas(id);


--
-- Name: workbooks workbooks_mapel_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workbooks
    ADD CONSTRAINT workbooks_mapel_id_foreign FOREIGN KEY (mapel_id) REFERENCES public.mapel(id);


--
-- PostgreSQL database dump complete
--

\unrestrict Jo7LxIYuxxajJ5dIhokSjHRfuxCUPtCjfP8f4vsEBkGxHb46CJ0dsraSR4jRcaB

