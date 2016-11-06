<?php
class MY_Upload extends CI_Upload {


    public function is_allowed_filetype($ignore_mime = true)
    {
        if ($this->allowed_types === '*')
        {
            return TRUE;
        }

        if (empty($this->allowed_types) OR ! is_array($this->allowed_types))
        {
            $this->set_error('upload_no_file_types', 'debug');
            return FALSE;
        }

        $ext = strtolower(ltrim($this->file_ext, '.'));

        if ( ! in_array($ext, $this->allowed_types, TRUE))
        {
            return FALSE;
        }

        // Images get some additional checks
        if (in_array($ext, array('gif','obj','mlt','pat', 'jpg', 'jpeg', 'jpe', 'png'), TRUE) && @getimagesize($this->file_temp) === FALSE)
        {
            return FALSE;
        }

        if ($ignore_mime === TRUE)
        {
            return TRUE;
        }

        if (isset($this->_mimes[$ext]))
        {
            return is_array($this->_mimes[$ext])
                ? in_array($this->file_type, $this->_mimes[$ext], TRUE)
                : ($this->_mimes[$ext] === $this->file_type);
        }

        return FALSE;
    }
}
?>