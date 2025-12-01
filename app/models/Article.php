<?php

namespace Polinema\WebProfilLabSe\Models;

use Polinema\WebProfilLabSe\Core\Database;
use PDO;
use Exception;

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all articles
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->query('SELECT * FROM article ORDER BY created_at DESC');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Article getAll Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get article by ID
     */
    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM article WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Article getById Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get article by slug
     */
    public function getBySlug($slug)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM article WHERE slug = :slug LIMIT 1");
            $stmt->execute([':slug' => $slug]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Article getBySlug Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create new article
     */
    public function create($data)
    {
        try {
            $query = "INSERT INTO article (title, slug, gambar_url, ringkasan, content, created_at) 
                      VALUES (:title, :slug, :gambar_url, :ringkasan, :content, CURRENT_TIMESTAMP)";

            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':title'      => $data['title'],
                ':slug'       => $data['slug'],
                ':gambar_url' => $data['gambar_url'] ?? null,
                ':ringkasan'  => $data['ringkasan'] ?? null,
                ':content'    => $data['content']
            ]);
        } catch (Exception $e) {
            error_log('Article create Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update article
     */
    public function update($id, $data)
    {
        try {
            $query = "UPDATE article 
                      SET title = :title, 
                          slug = :slug, 
                          ringkasan = :ringkasan, 
                          content = :content,
                          updated_at = CURRENT_TIMESTAMP";

            $params = [
                ':title'     => $data['title'],
                ':slug'      => $data['slug'],
                ':ringkasan' => $data['ringkasan'] ?? null,
                ':content'   => $data['content'],
                ':id'        => $id
            ];

            // Jika ada gambar baru
            if (isset($data['gambar_url'])) {
                $query .= ", gambar_url = :gambar_url";
                $params[':gambar_url'] = $data['gambar_url'];
            }

            $query .= " WHERE id = :id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (Exception $e) {
            error_log('Article update Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete article
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM article WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            error_log('Article delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate slug from title
     */
    public function generateSlug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Cek uniqueness
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->getBySlug($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Get latest articles (for public)
     */
    public function getLatest($limit = 6)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM article 
                                        ORDER BY created_at DESC 
                                        LIMIT :limit");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Article getLatest Error: ' . $e->getMessage());
            return [];
        }
    }
}