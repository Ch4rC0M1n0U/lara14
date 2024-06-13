export interface UserData {
id: string;
name: string;
email: string;
services?: string | null;
telUser?: string | null;
Matricule?: string | null;
created_at?: string | null;
updated_at?: string | null;
email_verified_at?: string | null;
password: string;
two_factor_secret?: string | null;
two_factor_recovery_codes?: string | null;
remember_token?: string | null;
profile_photo_path?: string | null;
};
