import * as SecureStore from 'expo-secure-store';
import { v4 as uuidv4 } from 'uuid';

export async function getDeviceId() {

  // ✅ iOS + Android: dùng SecureStore
  let id = await SecureStore.getItemAsync('device_id');

  if (!id) {
    id = uuidv4();
    await SecureStore.setItemAsync('device_id', id);
  }

  return id;
}
