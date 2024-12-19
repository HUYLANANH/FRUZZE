export type UserProfileToken = {
  username: string;
  email: string;
  token: string;
  role: string; 
};

export type UserProfile = {
  username: string;
  token: string;
  role: string; 
};

export type User = {
  username: string;
  email: string;
  password?: string; 
  nameOfUser: string; 
  token: string;
  image: string | null;
  birthDay: string | null;
};

export type UserInformation = {
  image: string | null; 
  birthDay: string;
};
